@extends('layouts.app')

@php
    use Illuminate\Support\Facades\Request;

    $id = Request::route('id');
@endphp

@section('content')
    <div id="rating-section" class="text-white" data-movie-id="{{ $id }}">
        <p>Movie ID: {{ $id }}</p>
        <h3>Rate this movie</h3>
        <div class="flex items-center">
            @for ($i = 1; $i <= 10; $i++)
                <svg class="w-4 h-4 text-yellow-300 star ms-1" data-rating="{{ $i }}" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path
                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
            @endfor
            <span class="px-4"> Avg: <span id="average-rating">{{ number_format($movie->averageRating()) }}</span></span>
        </div>

        <p>Your rating: <span id="selected-rating">Not rated</span></p>
        <button type="button" id="submit-rating" disabled
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Submit
            Rating</button>
        <p id="rating-message"></p>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ratingSection = document.getElementById('rating-section');
            const movieId = ratingSection.dataset.movieId;
            const stars = document.querySelectorAll('.star');
            const selectedRatingSpan = document.getElementById('selected-rating');
            const submitButton = document.getElementById('submit-rating');
            let selectedRating = 0;

            console.log('Movie ID:', movieId);
            console.log('Stars:', stars);

            stars.forEach(star => {
                star.addEventListener('click', function() {
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
@endsection
