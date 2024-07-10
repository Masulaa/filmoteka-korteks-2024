@extends('layouts.app')

@php
    use Illuminate\Support\Facades\Request;
    use App\Models\Movie;
    use App\Models\User;
    use App\Models\Rating;

    $id = Request::route('id');
    $movie = Movie::find($id);
    $user = Auth::user();
    $rating = Rating::where('movie_id', $movie->id)
        ->where('user_id', $user->id)
        ->first();

    $userRating = $rating ? $rating->rating : 0;
    $averageRating = $movie->averageRating();
    $countRatings = $movie->countRatings();
@endphp

@section('content')
    <section class="w-full transition-colors duration-300 dark:bg-gray-900"
        style="background-image: linear-gradient(to top, rgba(0,0,0), rgba(0,0,0,0.98),rgba(0,0,0,0.8) ,rgba(0,0,0,0.4)),url('https://image.tmdb.org/t/p/original/{{ $movie->backdrop_path }}'); background-position: top; background-size: cover;">
        <div
            class="max-w-7xl mx-auto lg:py-36 sm:py-[136px] sm:pb-28 xs:py-28 xs:pb-12 pt-24 pb-8 flex flex-row lg:gap-12 md:gap-10 gap-8 justify-center">
            <div class="transition duration-500 transform poster hover:scale-105">
                <img src="https://image.tmdb.org/t/p/w500/{{ $movie->image }}" alt="{{ $movie->title }}"
                    class="rounded-lg shadow-lg w-80 animate-fade-in">
            </div>
            <div
                class="text-gray-300 animate-fade-in dark:text-gray-200 sm:max-w-[80vw] max-w-[90vw] md:max-w-[520px] font-nunito flex flex-col lg:gap-5 sm:gap-4 xs:gap-[14px] gap-3 mb-8 flex-1">
                <h2 class="text-4xl font-bold md:max-w-[420px] animate-fade-in">{{ $movie->title }}</h2>
                <ul class="flex flex-row items-center sm:gap-[14px] xs:gap-3 gap-[6px] flex-wrap">
                    @foreach (explode(',', $movie->genre) as $genre)
                        <li
                            class="px-3 py-1 text-sm text-white transition-all duration-300 bg-gray-800 rounded-full dark:bg-gray-700 hover:bg-gray-700 dark:hover:bg-gray-600">
                            {{ trim($genre) }}</li>
                    @endforeach
                </ul>
                <p class="border-b-[1px] pb-6 transition-all duration-300">
                    <span id="overview" class="block">
                        {{ Str::limit($movie->overview, 200, '') }}
                    </span>
                    @if (strlen($movie->overview) > 200)
                        <span id="overview-full" class="hidden">
                            {{ $movie->overview }}
                        </span>
                        <button type="button" id="toggle-overview"
                            class="ml-1 font-bold transition-all duration-300 hover:underline">
                            Show more
                        </button>
                    @endif
                </p>
                <div class="mt-1 text-gray-300 dark:text-gray-200">
                    <p><span class="font-semibold">Director:</span> {{ $movie->director }}</p>
                    <p><span class="font-semibold">Release Date:</span> {{ $movie->release_date }}</p>
                </div>

                <h3 class="">Cast:</h3>
                <div class="flex w-96 flex-wrap md:gap-4 sm:gap-[14px] gap-2 sm:-mt-2 xs:-mt-[6px] -mt-1">
                    @foreach ($movie->cast as $actor)
                        <div class="flex flex-col justify-start gap-2 transition duration-500 transform hover:scale-110">
                            @if ($actor['profile_path'])
                                <div class="md:h-[96px] md:w-[64px] h-[54px] w-[40px]">
                                    <img src="{{ $actor['profile_path'] }}" alt="{{ $actor['name'] }}"
                                        class="object-cover rounded-md shadow-md">
                                </div>
                            @endif
                            <h4
                                class="text-gray-300 dark:text-gray-200 md:text-[12px] sm:text-[10.75px] text-[10px] md:max-w-[64px] text-center font-semibold sm:-mt-0 leading-snug max-w-[40px]">
                                {{ $actor['name'] }}</h4>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4 rating">
                    <h3 class="mb-2 text-xl font-semibold animate-fade-in">Rate this movie</h3>
                    <div id="rating-section" class="flex items-center space-x-1" data-movie-id="{{ $movie->id }}"
                        data-user-rating="{{ $userRating }}">
                        @for ($i = 1; $i <= 10; $i++)
                            <svg class="w-8 h-8 text-gray-300 transition-colors duration-200 ease-in-out cursor-pointer star {{ $i <= $userRating ? 'text-yellow-300' : '' }}"
                                data-rating="{{ $i }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 22 20">
                                <path
                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                            </svg>
                        @endfor
                        <span class="ml-2 text-lg">Your rating: <span id="selected-rating"
                                class="font-semibold">{{ $userRating }}</span></span>
                    </div>
                    <button id="submit-rating"
                        class="px-4 py-2 mt-2 font-bold text-white transition-colors duration-300 bg-indigo-700 rounded hover:bg-indigo-900"
                        {{ $userRating ? '' : 'disabled' }}>
                        Submit Rating
                    </button>
                    <p id="rating-message" class="mt-2"></p>
                    <p class="mt-2">Average Rating: <span id="average-rating">{{ $movie->averageRating() }}</span>
                        ({{ $movie->countRatings() }} ratings)</p>
                    <div class="flex gap-4 my-4">
                        <a href="{{ route('movies.watch', ['id' => $movie->id]) }}"
                            class="inline-block px-6 py-3 text-xl font-bold text-white transition-colors duration-300 transform bg-indigo-700 rounded-lg hover:bg-indigo-900 hover:scale-105">Watch
                            Movie</a>
                        <a href="https://www.youtube.com/watch?v={{ $movie->trailer_link }}"
                            class="inline-block px-6 py-3 text-xl font-bold text-white transition-colors duration-300 transform bg-indigo-700 rounded-lg hover:bg-indigo-900 hover:scale-105">
                            Watch Trailer</a>
                    </div>
                </div>
            </div>
    </section>
    <div class="py-4 bg-black" style="background-image: linear-gradient(to bottom, rgba(0,0,0,1), rgba(0,0,0,0.001));"
        class="mb-20 dark:bg-gray-900">
        <section class="mx-auto reviews max-w-7xl">
            <h3 class="mb-4 text-2xl font-bold text-white dark:text-gray-200 animate-fade-in">Reviews</h3>
            <div class="mb-6">
                <h4 class="mb-2 text-xl font-semibold text-white dark:text-gray-200">Add a Review</h4>
                <form action="{{ route('reviews.store', $movie->id) }}" method="POST">
                    @csrf
                    <textarea name="content" rows="3"
                        class="w-full p-2 text-gray-800 transition-colors duration-300 bg-gray-200 border rounded dark:text-white dark:bg-gray-800"
                        required placeholder="Write your review here..."></textarea>
                    <button type="submit"
                        class="px-4 py-2 mt-2 font-bold text-white transition-colors duration-300 bg-green-500 rounded hover:bg-green-700">
                        Submit Review
                    </button>
                </form>
            </div>
            <div class="space-y-4 review-list">
                @forelse ($movie->reviews as $review)
                    <div
                        class="p-4 transition-all duration-300 bg-gray-800 rounded-lg shadow dark:bg-gray-700 hover:shadow-lg">
                        <p class="mb-2 text-gray-300 dark:text-gray-200">{{ $review->content }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">By: {{ $review->user->name }} on
                            {{ $review->created_at->format('d M Y') }}</p>
                    </div>
                @empty
                    <p class="text-gray-100">No reviews yet.</p>
                @endforelse
            </div>
        </section>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const overviewSpan = document.getElementById('overview');
            const overviewFullSpan = document.getElementById('overview-full');
            const toggleButton = document.getElementById('toggle-overview');

            if (toggleButton) {
                toggleButton.addEventListener('click', function() {
                    if (overviewSpan.classList.contains('hidden')) {
                        overviewSpan.classList.remove('hidden');
                        overviewFullSpan.classList.add('hidden');
                        toggleButton.textContent = 'Show more';
                    } else {
                        overviewSpan.classList.add('hidden');
                        overviewFullSpan.classList.remove('hidden');
                        toggleButton.textContent = 'Show less';
                    }
                });
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const ratingSection = document.getElementById('rating-section');
            const movieId = ratingSection.dataset.movieId;
            const userRating = ratingSection.dataset.userRating;
            const stars = document.querySelectorAll('.star');
            const selectedRatingSpan = document.getElementById('selected-rating');
            const submitButton = document.getElementById('submit-rating');
            let selectedRating = userRating ? parseInt(userRating) : 0;

            function updateStars(rating) {
                stars.forEach(star => {
                    if (parseInt(star.dataset.rating) <= rating) {
                        star.classList.remove('text-gray-300');
                        star.classList.add('text-yellow-300');
                    } else {
                        star.classList.remove('text-yellow-300');
                        star.classList.add('text-gray-300');
                    }
                });
            }

            updateStars(selectedRating);

            stars.forEach(star => {
                star.addEventListener('click', function() {
                    selectedRating = parseInt(this.dataset.rating);
                    updateStars(selectedRating);
                    selectedRatingSpan.textContent = selectedRating;
                    submitButton.disabled = false;
                });
            });

            submitButton.addEventListener('click', function() {
                if (selectedRating === 0) {
                    alert('Please select a rating before submitting.');
                    return;
                }

                fetch(`/movies/${movieId}/rate`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            rating: selectedRating
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('average-rating').textContent = data.average_rating
                                .toFixed(1);
                            document.getElementById('rating-message').textContent = data.message;
                        } else {
                            document.getElementById('rating-message').textContent =
                                'Failed to save rating';
                        }
                    })
                    .catch(error => {
                        document.getElementById('rating-message').textContent = 'An error occurred';
                        console.error('Fetch error:', error);
                    });
            });
        });

        document.querySelectorAll('.animate-fade-in').forEach((element, index) => {
            element.style.animationDelay = `${index * 0.1}s`;
        });
    </script>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-out forwards;
            opacity: 0;
        }
    </style>
@endsection
