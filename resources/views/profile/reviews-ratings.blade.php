@extends('layouts.app')

@section('content')
    <div class="container p-4 mx-auto">
        <h1 class="mb-4 text-2xl font-bold">Your Reviews and Ratings</h1>

        <div class="mb-6">
            <h2 class="mb-2 text-xl font-semibold">Your Reviews</h2>
            @if ($reviews->count())
                <ul>
                    @foreach ($reviews as $review)
                        <li class="mb-4">
                            <h3 class="text-lg font-bold">{{ $review->movie->title }}</h3>
                            <p>{{ $review->content }}</p>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>You have not reviewed any movies yet.</p>
            @endif
        </div>

        <div>
            <h2 class="mb-2 text-xl font-semibold">Your Ratings</h2>
            @if ($ratings->count())
                <ul>
                    @foreach ($ratings as $rating)
                        <li class="mb-4">
                            <h3 class="text-lg font-bold">{{ $rating->movie->title }}</h3>
                            <p>Rating: {{ $rating->rating }}/10</p>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>You have not rated any movies yet.</p>
            @endif
        </div>
    </div>
@endsection
