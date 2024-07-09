@extends('layouts.app')
@section('content')
    <div class="container max-w-4xl px-4 py-8 mx-auto my-6">
        <h1 class="mb-8 text-3xl font-bold text-white">Your Reviews and Ratings</h1>

        <div class="mb-12">
            <h2 class="mb-4 text-2xl font-semibold text-white">Your Reviews</h2>
            @if ($reviews->count())
                <ul class="space-y-6">
                    @foreach ($reviews as $review)
                        <li class="p-6 bg-white rounded-lg shadow-md">
                            <h3 class="mb-2 text-xl font-bold text-gray-900">{{ $review->movie->title }}</h3>
                            <p class="text-gray-600">{{ $review->content }}</p>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="italic text-white">You have not reviewed any movies yet.</p>
            @endif
        </div>

        <div>
            <h2 class="mb-4 text-2xl font-semibold text-white">Your Ratings</h2>
            @if ($ratings->count())
                <ul class="space-y-6">
                    @foreach ($ratings as $rating)
                        <li class="p-6 bg-white rounded-lg shadow-md">
                            <h3 class="mb-2 text-xl font-bold text-gray-900">{{ $rating->movie->title }}</h3>
                            <p class="text-gray-600">Rating: <span
                                    class="font-semibold text-indigo-600">{{ $rating->rating }}/10</span></p>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="italic text-white">You have not rated any movies yet.</p>
            @endif
        </div>
    </div>
@endsection
