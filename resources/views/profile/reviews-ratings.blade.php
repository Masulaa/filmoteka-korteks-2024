@extends('layouts.app')
@section('content')
<div class="container max-w-xl px-4 py-8 mx-auto my-6">
    <h1 class="mb-8 text-3xl font-bold text-white">Your Reviews and Ratings</h1>

    <div class="mb-12">
        <h2 class="mb-4 text-2xl font-semibold text-white">Your Reviews</h2>
        @if ($reviews->count())
            <ul class="space-y-6">

                @foreach ($reviews as $review)
                    <li class="p-2 bg-gray-800 rounded-lg shadow-md">
                        <a href="{{ route('movies.index') }}/{{ $review->movie->id }}"
                            class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <img src="{{ $review->movie->image }}" alt="{{ $review->movie->title }}"
                                    class="object-cover w-20 rounded-lg shadow-md">
                                <div>
                                    <h3 class="text-xl font-bold text-white">{{ $review->movie->title }}</h3>
                                    <p class="text-sm text-white ">Director: {{ $review->movie->director }}</p>
                                    <p class="text-sm text-white ">Release Date: {{ $review->movie->release_date }}
                                    </p>
                                    <p class="text-sm text-white">Date: {{ $review->created_at }}

                                    <p class="mt-4 text-white">Your Review: {{ $review->content }}</p>
                                </div>
                            </div>
                            <form action="{{ route('reviews.destroy', $review->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="p-1 text-xs text-white bg-red-500 rounded hover:bg-red-600 focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                                    Delete
                                </button>
                            </form>
                        </a>

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
                    <li class="p-2 bg-gray-800 rounded-lg shadow-md">
                        <a href="{{ route('movies.index') }}/{{ $rating->movie->id }}"
                            class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <img src="{{ $rating->movie->image }}" alt="{{ $rating->movie->title }}"
                                    class="object-cover w-20 rounded-lg shadow-md">
                                <div>
                                    <h3 class="text-xl font-bold text-white">{{ $rating->movie->title }}</h3>
                                    <p class="text-sm text-white">Director: {{ $rating->movie->director }}</p>
                                    <p class="text-sm text-white">Release Date: {{ $rating->movie->release_date }}
                                    </p>
                                    <p class="text-sm text-white">Date: {{ $rating->created_at }}
                                    </p>
                                    <p class="mt-4 text-white">Your Rating: <span
                                            class="font-semibold text-indigo-600">{{ $rating->rating }}/10</span></p>
                                </div>
                            </div>
                            <form action="{{ route('ratings.destroy', $rating->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="p-1 text-xs text-white bg-red-500 rounded hover:bg-red-600 focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                                    Delete
                                </button>
                            </form>

                        </a>

                    </li>
                @endforeach
            </ul>
        @else
            <p class="italic text-white">You have not rated any movies yet.</p>
        @endif
    </div>
</div>
@endsection