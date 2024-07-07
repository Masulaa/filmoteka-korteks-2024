@extends('layouts.app')

@php
    use Illuminate\Support\Facades\Request;
    use App\Models\Movie;
    use App\Models\User;

    $id = Request::route('id');
    $movie = Movie::find($id);
    $averageRating = $movie->averageRating();
    $countRatings = $movie->countRatings();
@endphp

@section('content')
<section class="w-full"
    style="background-image: linear-gradient(to top, rgba(0,0,0), rgba(0,0,0,0.98),rgba(0,0,0,0.8) ,rgba(0,0,0,0.4)),url('https://image.tmdb.org/t/p/original/{{ $movie->backdrop_path }}'); background-position: top; background-size: cover;">
    <div
        class="max-w-7xl mx-auto lg:py-36 sm:py-[136px] sm:pb-28 xs:py-28 xs:pb-12 pt-24 pb-8 flex flex-row lg:gap-12 md:gap-10 gap-8 justify-center">
        <div class="poster">
            <img src="https://image.tmdb.org/t/p/w500/{{ $movie->image }}" alt="{{ $movie->title }}"
                class="rounded-lg shadow-lg w-80">
        </div>
        <div
            class="text-gray-300 sm:max-w-[80vw] max-w-[90vw] md:max-w-[520px] font-nunito flex flex-col lg:gap-5 sm:gap-4 xs:gap-[14px] gap-3 mb-8 flex-1">
            <h2 class="text-4xl font-bold md:max-w-[420px]">{{ $movie->title }}</h2>
            <ul class="flex flex-row items-center sm:gap-[14px] xs:gap-3 gap-[6px] flex-wrap">
                @foreach (explode(',', $movie->genre) as $genre)
                    <li class="px-3 py-1 text-sm text-white bg-gray-800 rounded-full">{{ trim($genre) }}</li>
                @endforeach
            </ul>
            <p class="b border-b-[1px] pb-6">
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
            <div class="mt-1 text-gray-300">
                <p><span class="font-semibold">Director:</span> {{ $movie->director }}</p>
                <p><span class="font-semibold">Release Date:</span> {{ $movie->release_date }}</p>
            </div>

            <h3>Cast:</h3>
            <div class="flex w-96 flex-wrap md:gap-4 sm:gap-[14px] gap-2  sm:-mt-2 xs:-mt-[6px] -mt-1">
                @foreach ($movie->cast as $actor)
                    <div class="flex flex-col justify-start gap-2">
                        @if ($actor['profile_path'])
                            <div class="md:h-[96px] md:w-[64px] h-[54px] w-[40px]">
                                <img src="{{ $actor['profile_path'] }}" alt="{{ $actor['name'] }}"
                                    class="object-cover rounded-md shadow-md ">
                            </div>
                        @endif
                        <h4
                            class="text-gray-300 md:text-[12px] sm:text-[10.75px] text-[10px] md:max-w-[64px] text-center font-semibold sm:-mt-0 leading-snug max-w-[40px]">
                            {{ $actor['name'] }}
                        </h4>
                    </div>
                @endforeach
            </div>

            <!-- Options -->
            <div class="mt-4 lg:row-span-3 lg:mt-0">
                <h2 class="sr-only">Movie informations</h2>
                <p class="text-3xl tracking-tight text-white">{{ $movie->genre }}</p>

                <!-- Reviews -->
                <div class="mt-6">
                    <h3 class="sr-only">Ratings</h3>
                    <div class="flex items-center">
                        <div class="flex items-center">
                            <!-- Active: "text-white", Default: "text-gray-600" -->
                            <div id="rating-section" class="text-white" data-movie-id="{{ $id }}">
                                <div class="flex items-center">
                                    @for ($i = 1; $i <= 10; $i++)
                                        <svg class="w-6 h-6 text-yellow-300 star" data-rating="{{ $i }}" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                            <path
                                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                        </svg>
                                    @endfor

                                    <span class="px-4 text-lg">Avg:<span
                                            id="average-rating">{{ $averageRating }}</span></span>
                                    <a href="#"
                                        class="ml-3 text-sm font-medium text-white w-52 hover:text-gray-500">{{ $countRatings }}
                                        reviews</a>
                                </div>

                                <p class="py-2 ">Your rating: <span id="selected-rating">Not rated</span> </p>
                                <button type="button" id="submit-rating" disabled
                                    style="background-color: #1D4ED8; color: white; border-radius: 0.375rem; padding: 0.625rem 1.25rem;"
                                    class="hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium text-sm me-2 mb-2 focus:outline-none focus:ring-blue-800">Submit
                                    Rating
                                </button>
                                <p id="rating-message"></p>
                            </div>

                        </div>
                        <button id="submit-rating"
                            class="px-4 py-2 mt-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700" disabled>
                            Submit Rating
                        </button>
                        <p id="rating-message" class="mt-2"></p>
                        <p class="mt-2">Average Rating: <span id="average-rating">{{ $movie->averageRating() }}</span>
                            ({{ $movie->countRatings() }} ratings)</p>
                    </div>
                </div>
            </div>

            <div class="py-5 lg:col-span-2 lg:col-start-1 lg:border-r lg:border-gray-700 lg:pt-6 lg:pb-14 lg:pr-8">
                <!-- Description and details -->
                <div>
                    <h3 class="sr-only">Description</h3>

                    <div class="space-y-6">
                        <p class="text-base text-white">{{ $movie->director }}</p>
                    </div>
                </div>

                <div class="mt-10">
                    <h3 class="text-sm font-medium text-white">{{ $movie->release_date }}</h3>



                </div>
                <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                <div class="mt-4">
                    <h2 class="text-2xl font-bold tracking-tight text-white ">Add a Review</h2>
                    <form action="{{ route('reviews.store', $movie->id) }}" method="POST">
                        @csrf
                        <textarea name="content" rows="3" class="w-full p-2 text-white bg-gray-800 border rounded"
                            required placeholder="Write your review here..."></textarea> <button type="submit"
                            class="px-4 py-2 mt-2 font-bold text-white bg-green-500 rounded hover:bg-green-700">
                            Submit Review
                        </button>
                    </form>
                </div>
                <button type="submit"
                    style="background-color: #1D4ED8; color: white; border-radius: 0.375rem; padding: 0.625rem 1.25rem;"
                    class="hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium text-sm me-2 mb-2 focus:outline-none focus:ring-blue-800">Submit
                    Review</button>
                </form>
            </div>

            <!-- Prikazivanje komentara -->
            <div>
                <h3>Reviews</h3>
                @forelse ($movie->reviews as $review)
                    <div class="border p-3 mb-3">
                        <p>{{ $review->content }}</p>
                        <p>By: {{ $review->user->name }} on {{ $review->created_at->format('d M Y') }}</p>
                    </div>
                @empty
                    <p>No reviews yet.</p>
                @endforelse
            </div>
        </div>
        <script>
            // JS > PHP
            document.addEventListener('DOMContentLoaded', function () {
                const overviewSpan = document.getElementById('overview');
                const overviewFullSpan = document.getElementById('overview-full');
                const toggleButton = document.getElementById('toggle-overview');

                if (toggleButton) {
                    toggleButton.addEventListener('click', function () {
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

            function toggleOverview() {
                const overview = document.getElementById('overview');
                const button = overview.nextElementSibling;

                if (overview.classList.contains('truncate')) {
                    overview.classList.remove('truncate');
                    button.textContent = 'show less';
                } else {
                    overview.classList.add('truncate');
                    button.textContent = 'show more';
                }
            }

            document.addEventListener('DOMContentLoaded', function () {
                const ratingSection = document.getElementById('rating-section');
                const movieId = ratingSection.dataset.movieId;
                const stars = document.querySelectorAll('.star');
                const selectedRatingSpan = document.getElementById('selected-rating');
                const submitButton = document.getElementById('submit-rating');
                let selectedRating = 0;

                stars.forEach(star => {
                    star.addEventListener('click', function () {
                        selectedRating = this.dataset.rating;
                        updateStars(selectedRating);
                        selectedRatingSpan.textContent = selectedRating;
                        submitButton.disabled = false;
                    });
                });

                function updateStars(rating) {
                    stars.forEach(star => {
                        if (parseInt(star.dataset.rating) <= parseInt(rating)) {
                            star.classList.remove('text-gray-300');
                            star.classList.add('text-yellow-300');
                        } else {
                            star.classList.remove('text-yellow-300');
                            star.classList.add('text-gray-300');
                        }
                    });
                }

                submitButton.addEventListener('click', function () {
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
        </script>
        @endsection