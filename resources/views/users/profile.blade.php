@extends('layout')

@section('content')
    <div class="bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                My Profile
            </h2>
        </header>

        <form action="/profile" method="POST">
            @csrf
            <div class="mb-6">
                <label for="name" class="inline-block text-lg mb-2">
                    Name
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name"
                    value="{{ auth()->user()->name }}" />
                @error('name')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="inline-block text-lg mb-2">Email</label>
                <input type="email" class="border border-gray-200 rounded p-2 w-full" name="email"
                    value="{{ auth()->user()->email }}" />
                @error('email')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="change-pass" onclick="showDiv()">
                <span>Change your password</span>
                <i class="fa-solid fa-angle-down"></i>
            </div>
            <div id="passwordsDiv" style="display: @auth
                @error('old-password')
                block
                @enderror
                @error('new-password')
                block
                @enderror
            @endauth"
            >
                <div class="mb-6">
                    <label for="old-password" class="inline-block text-lg mb-2">
                        Old Password
                    </label>
                    <input type="password" class="border border-gray-200 rounded p-2 w-full" name="old-password" />
                    @error('old-password')
                        <p class="text-red-500 text-xs mt-1">
                            old password required
                        </p>
                    @enderror
                    @error('wrongPassword')
                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>
                    @enderror


                </div>

                <div class="mb-6">
                    <label for="new-password" class="inline-block text-lg mb-2">
                        New Password
                    </label>
                    <input type="password" class="border border-gray-200 rounded p-2 w-full" name="new-password" />
                    @error('new-password')
                        <p class="text-red-500 text-xs mt-1">
                            new password and confirmation doesn't match
                        </p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="new-password_confirmation" class="inline-block text-lg mb-2">
                        Confirm New Password
                    </label>
                    <input type="password" class="border border-gray-200 rounded p-2 w-full"
                        name="new-password_confirmation" />
                </div>



            </div>


            <div class="mb-6">
                <button type="submit" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                    Update Profile
                </button>
            </div>


        </form>
    </div>
    </div>
@endsection
