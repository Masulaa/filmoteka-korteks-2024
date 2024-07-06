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
<div class="text-white">
    <div class="pt-6">
        <nav aria-label="Breadcrumb">
            <ol role="list" class="flex items-center max-w-2xl px-4 mx-auto space-x-2 sm:px-6 lg:max-w-7xl lg:px-8">
                <li>
                    <div class="flex items-center">
                        <a href="#" class="mr-2 text-sm font-medium text-gray-400 hover:text-white">Movie</a>
                        <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" aria-hidden="true"
                            class="w-4 h-5 text-gray-600">
                            <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                        </svg>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <a href="#"
                            class="mr-2 text-sm font-medium text-gray-400 hover:text-white">{{ $movie->genre }}</a>
                        <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" aria-hidden="true"
                            class="w-4 h-5 text-gray-600">
                            <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                        </svg>
                    </div>
                </li>
                <li class="text-sm">
                    <a href="#" aria-current="page"
                        class="font-medium text-gray-500 hover:text-white">{{ $movie->title }}</a>
                </li>
            </ol>
        </nav>

        <!-- Image gallery -->
        <div class="max-w-2xl mx-auto mt-6 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:gap-x-8 lg:px-8">
            <div class="hidden overflow-hidden rounded-lg aspect-h-4 aspect-w-3 lg:block">
                <img src="{{ $movie->image }}" alt="Two each of gray, white, and black shirts laying flat."
                    class="object-cover object-center h-20 w-30">
            </div>
        </div>
    </div>

    <!-- Product info -->
    <div
        class="mx-auto max-w-2xl px-4 pb-16 pt-10 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:grid-rows-[auto,auto,1fr] lg:gap-x-8 lg:px-8 lg:pb-24 lg:pt-16">
        <div class="lg:col-span-2 lg:border-r lg:border-gray-700 lg:pr-8">
            <h1 class="text-2xl font-bold tracking-tight text-white sm:text-3xl">{{ $movie->title }}</h1>
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
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-white-600 dark:hover:bg-white-700 focus:outline-none dark:focus:ring-blue-800">Submit
                                Rating</button>
                            <p id="rating-message"></p>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <div class="py-10 lg:col-span-2 lg:col-start-1 lg:border-r lg:border-gray-700 lg:pt-6 lg:pb-16 lg:pr-8">
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
            @endsection










            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const ratingSection = document.getElementById('rating-section');
                    const movieId = ratingSection.dataset.movieId;
                    const stars = document.querySelectorAll('.star');
                    const selectedRatingSpan = document.getElementById('selected-rating');
                    const submitButton = document.getElementById('submit-rating');
                    let selectedRating = 0;

                    console.log('Movie ID:', movieId);
                    console.log('Stars:', stars);

                    stars.forEach(star => {
                        star.addEventListener('click', function () {
                            selectedRating = this.dataset.rating;
                            updateStars(selectedRating);
                            selectedRatingSpan.textContent = selectedRating;
                            submitButton.disabled = false;
                            console.log('Selected rating:', selectedRating);
                        });
                    });

                    function updateStars(rating) {
                        stars.forEach(star => {
                            if (parseInt(star.dataset.rating) <= parseInt(rating)) {
                                star.style.color = 'gold';
                            } else {
                                star.style.color = 'gray';
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
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                if (data.success) {
                                    document.getElementById('average-rating').textContent = data.average_rating
                                        .toFixed(1);
                                    document.getElementById('rating-message').textContent = data.message;
                                    console.log('Rating updated successfully');
                                } else {
                                    document.getElementById('rating-message').textContent =
                                        'Failed to save rating';
                                    console.error('Rating update failed:', data.message);
                                }
                            })
                            .catch(error => {
                                document.getElementById('rating-message').textContent = 'An error occurred';
                                console.error('Fetch error:', error);
                            });
                    });
                });
            </script>