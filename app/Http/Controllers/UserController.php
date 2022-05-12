<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    // show registeration form

    public function create()
    {
        return view('users.register');
    }


    public function store()
    {

        $formFields = request()->validate([
            'name' => ['required', 'min:4'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed']
        ]);

        // hash password
        $formFields['password'] = bcrypt($formFields['password']);

        // store user in db
        $user = User::create($formFields);

        // automatically login
        auth()->login($user);

        return redirect('/')->with('message', 'User created and logged in');
    }

    // logout
    public function logout()
    {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/')->with('message', 'You have been logged out!');
    }

    // login page
    public function login()
    {
        return view('users.login');
    }


    public function authenticate()
    {
        $formFields = request()->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (auth()->attempt($formFields)) {
            request()->session()->regenerate();
            return redirect('/')->with('message', 'You are now logged in!');
        }

        return back()->withErrors(['wrongAuth' => 'Wrong email or password']);
    }

    public function profile()
    {

        return view('users.profile');
    }

    public function update(Request $request)
    {
        $user = User::find(auth()->id());
        $formFields = $request->validate([
            'name' => ['required', 'min:4'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore(auth()->id())]
        ]);

        if (!empty($request['old-password']) ||
         !empty($request['new-password']) ||
         !empty($request['new-password_confirmation'])
         ) {

            $formFields = $request->validate([
                'old-password' => ['required']
            ]);

            $formFields = $request->validate([
                'new-password' => ['required','confirmed'],
            ]);


            if (! Hash::check($request['old-password'], auth()->user()->password))
            {
                return back()->withErrors(['wrongPassword' => 'Password is incorrect']);
            }

            $formFields['password'] = bcrypt($request['new-password']);
        }

        // insert updated data
        $user->update($formFields);
        return back()->with('message', 'Your profile updated successfully!' ) ;

    }
}
