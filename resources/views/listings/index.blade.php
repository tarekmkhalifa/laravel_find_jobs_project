@extends('layout')

@section('content')
    @include('partials._hero')
    @include('partials._search')
    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
        @foreach ($listings as $listing)
            <div class="bg-gray-50 border border-gray-200 rounded p-6">
                <div class="flex">
                    <a href="/listings/{{ $listing->id }}">
                        <img class="hidden w-48 mr-6 md:block"
                            src=" {{ $listing->logo ? asset('storage/' . $listing->logo) : asset('images/no-image.png') }} "
                            alt="" />

                    </a>
                    <div>
                        <h3 class="text-2xl">
                            <a href="/listings/{{ $listing->id }}">
                                {{ $listing->title }}
                            </a>
                        </h3>
                        <div class="text-xl font-bold mb-4">{{ $listing->company }}</div>

                        @include('partials.listing-tags')

                        <div class="text-lg mt-4">
                            <i class="fa-solid fa-location-dot"></i> {{ $listing->location }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-6 p-4">
        {{ $listings->links() }}
    </div>
@endsection
