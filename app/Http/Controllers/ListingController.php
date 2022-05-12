<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // listing home page
    public function index()
    {
        $listings = Listing::latest()->filter(request(['tag', 'search']))->paginate(6);
        return view('listings.index', compact('listings'));
    }

    // show single listing page
    public function show($id)
    {
        $listing = Listing::findOrFail($id);
        return view('listings.show', compact('listing'));
    }

    // show create listing page
    public function create()
    {
        return view('listings.create');
    }

    // store listing in db
    public function store()
    {
        $formFields = request()->validate([
            'company' => ['required', Rule::unique('listings', 'company')],
            'title' => 'required',
            'location' => 'required',
            'email' => ['required', 'email'],
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required',
            'logo' => ['nullable', 'mimes:jpg,jpeg,png']
        ]);

        if (request()->hasFile('logo')) {
            $formFields['logo'] = request()->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();
        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing Has Been Created Successfully!');
    }

    // show edit listing page
    public function edit($id)
    {
        $listing = Listing::findOrFail($id);
        return view('listings.edit', compact('listing'));
    }

    // update listing in db
    public function update($id)
    {
        $listing = Listing::find($id);

        // make sure logged in user is owner
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $formFields = request()->validate([
            'company' => ['required', Rule::unique('listings', 'company')->ignore($id)],
            'title' => 'required',
            'location' => 'required',
            'email' => ['required', 'email'],
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required',
            'logo' => ['nullable', 'mimes:jpg,jpeg,png']
        ]);

        if (request()->hasFile('logo')) {
            $formFields['logo'] = request()->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return back()->with('message', 'Listing Has Been Updated Successfully!');
    }

    // delete listing
    public function destroy($id)
    {
        $listing = Listing::find($id);

        // make sure logged in user is owner
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $listing->delete();
        return redirect('/')->with('message', 'Listing Has Been Deleted Successfully!');
    }

    // show manage listings page
    public function manageListings()
    {
        $listings = Listing::latest()->where('user_id', auth()->id())->filter(request(['search']))->paginate(6);
        return view('listings.manage', compact('listings'));
    }
}
