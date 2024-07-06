@extends('layouts.app')

@section('content')
<div class="max-w-2xl px-4 pt-4 pb-16 mx-auto sm:px-6 sm:pb-24 lg:max-w-7xl lg:px-8">
    <h2 class="text-2xl font-bold tracking-tight text-white">Movies</h2>

    <div class="grid grid-cols-1 mt-6 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
        @foreach ($movies as $movie)
            <div class="relative group">

                <div
                    class="w-full overflow-hidden bg-gray-200 rounded-md aspect-h-1 aspect-w-1 lg:aspect-none group-hover:opacity-75 lg:h-80">
                    <img src="{{ $movie->image }}" alt="{{ $movie->title }}"
                        class="object-cover object-center w-full h-full lg:h-full lg:w-full">
                </div>
                <div class="flex justify-between mt-4">
                    <div>
                        <h3 class="text-sm text-gray-700">
                            <a href=" {{ route('movie', $movie->id) }}">
                                <span aria-hidden="true" class="absolute inset-0"></span>
                                {{ $movie->title }}
                            </a>
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">{{ $movie->genre }}</p>
                    </div>
                    <p class="text-sm font-medium text-gray-900">{{ $movie->director }}</p>
                </div>
            </div>
        @endforeach  <div class="mt-4">
            <h3>Add a Review</h3>
            <form action="{{ route('reviews.store', $movie->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="content">Comment:</label>
                    <textarea name="content" id="content" class="form-control" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="rating">Rating:</label>
                    <select name="rating" id="rating" class="form-control" required>
                        <option value="">Select Rating</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Submit Review</button>
            </form>
        </div>

        <!-- Prikazivanje komentara -->
        <div class="mt-4">
            <h3>Reviews</h3>
            @forelse ($movie->reviews as $review)
                <div class="border p-3 mb-3">
                    <p>{{ $review->content }}</p>
                    <p>Rating: {{ $review->rating }}</p>
                    <p>By: {{ $review->user->name }} on {{ $review->created_at->format('d M Y') }}</p>
                </div>
            @empty
                <p>No reviews yet.</p>
            @endforelse
        </div>
    </div>

</div>

<div class="mt-8">
    {{ $movies->links() }}
</div>
</div>
@endsection