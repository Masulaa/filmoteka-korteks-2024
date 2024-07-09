@extends('layouts.app')

@php
    use Illuminate\Support\Facades\Request;
    use App\Models\Series;

    $id = Request::route('id');
    $series = Series::find($id);
    // $averageRating = $series->averageRating();
    // $countRatings = $series->countRatings();
@endphp

@section('content')
    <section class="w-full"
        style="background-image: linear-gradient(to top, rgba(0,0,0), rgba(0,0,0,0.98),rgba(0,0,0,0.8) ,rgba(0,0,0,0.4)),url('https://image.tmdb.org/t/p/original/{{ $series->backdrop_path }}'); background-position: top; background-size: cover;">
        <div
            class="max-w-7xl mx-auto lg:py-36 sm:py-[136px] sm:pb-28 xs:py-28 xs:pb-12 pt-24 pb-8 flex flex-row lg:gap-12 md:gap-10 gap-8 justify-center">
            <div class="poster">
                <img src="https://image.tmdb.org/t/p/w500/{{ $series->image }}" alt="{{ $series->title }}"
                    class="rounded-lg shadow-lg w-80">
            </div>
            <div
                class="text-gray-300 sm:max-w-[80vw] max-w-[90vw] md:max-w-[520px] font-nunito flex flex-col lg:gap-5 sm:gap-4 xs:gap-[14px] gap-3 mb-8 flex-1">
                <h2 class="text-4xl font-bold md:max-w-[420px]">{{ $series->title }}</h2>
                <ul class="flex flex-row items-center sm:gap-[14px] xs:gap-3 gap-[6px] flex-wrap">
                    @foreach (explode(',', $series->genre) as $genre)
                        <li class="px-3 py-1 text-sm text-white bg-gray-800 rounded-full">{{ trim($genre) }}</li>
                    @endforeach
                </ul>
                <p class="b border-b-[1px] pb-6">
                    <span id="overview" class="block">
                        {{ Str::limit($series->overview, 200, '') }}
                    </span>
                    @if (strlen($series->overview) > 200)
                        <span id="overview-full" class="hidden">
                            {{ $series->overview }}
                        </span>
                        <button type="button" id="toggle-overview"
                            class="ml-1 font-bold transition-all duration-300 hover:underline">
                            Show more
                        </button>
                    @endif
                </p>
                <div class="mt-1 text-gray-300">
                    <p><span class="font-semibold">Creator:</span> {{ $series->creator }}</p>
                    <p><span class="font-semibold">First Air Date:</span> {{ $series->first_air_date }}</p>
                    <p><span class="font-semibold">Number of Seasons:</span> {{ $series->number_of_seasons }}</p>
                    <p><span class="font-semibold">Number of Episodes:</span> {{ $series->number_of_episodes }}</p>
                    <p><span class="font-semibold">Status:</span> {{ $series->status }}</p>
                </div>

                <h3>Cast:</h3>
                <div class="flex w-96 flex-wrap md:gap-4 sm:gap-[14px] gap-2  sm:-mt-2 xs:-mt-[6px] -mt-1">
                    @foreach ($series->cast as $actor)
                        <div class="flex flex-col justify-start gap-2">
                            @if ($actor['profile_path'])
                                <div class="md:h-[96px] md:w-[64px] h-[54px] w-[40px]">
                                    <img src="{{ $actor['profile_path'] }}" alt="{{ $actor['name'] }}"
                                        class="object-cover rounded-md shadow-md ">
                                </div>
                            @endif
                            <h4
                                class="text-gray-300 md:text-[12px] sm:text-[10.75px] text-[10px] md:max-w-[64px] text-center font-semibold sm:-mt-0 leading-snug max-w-[40px]">
                                {{ $actor['name'] }}</h4>
                        </div>
                    @endforeach
                </div>
                {{-- <div class="mt-4 rating">
                    <h3 class="mb-2 text-xl font-semibold">Rate this series</h3>
                    <div id="rating-section" class="flex items-center" data-series-id="{{ $series->id }}">
                        @for ($i = 1; $i <= 10; $i++)
                            <svg class="w-6 h-6 text-gray-300 star" data-rating="{{ $i }}" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path
                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                            </svg>
                        @endfor
                        <span class="ml-2">Your rating: <span id="selected-rating">Not rated</span></span>
                    </div>
                    <button id="submit-rating"
                        class="px-4 py-2 mt-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700" disabled>
                        Submit Rating
                    </button>
                    <p id="rating-message" class="mt-2"></p>
                    <p class="mt-2">Average Rating: <span id="average-rating">{{ $series->averageRating() }}</span>
                        ({{ $series->countRatings() }} ratings)</p>
                    <a href="{{ route('series.watch', ['id' => $series->id]) }}"
                        class="inline-block px-6 py-3 text-xl font-bold text-white bg-blue-500 rounded-lg hover:bg-blue-700">WATCH
                        SERIES</a>
                    <a href="{{ $series->trailer_link }}"
                        class="inline-block px-6 py-3 text-xl font-bold text-white bg-blue-500 rounded-lg hover:bg-blue-700">WATCH
                        TRAILER</a>
                </div> --}}
            </div>
        </div>
        <h1 class="p-2 text-lg font-bold text-center text-gray-100/90">Reviews and ratings are currently unavailable.
        </h1>
    </section>
    {{--   <div style="background-image: linear-gradient(to bottom, rgba(0,0,0,1), rgba(0,0,0,0.001));" class="mb-20">
       <section class="mx-auto reviews max-w-7xl">
            <h3 class="mb-4 text-2xl font-bold text-white">Reviews</h3>
            <div class="mb-6">
                <h4 class="mb-2 text-xl font-semibold text-white">Add a Review</h4>
                <form action="{{ route('reviews.store', $series->id) }}" method="POST">
                    @csrf
                    <textarea name="content" rows="3" class="w-full p-2 text-white bg-gray-800 border rounded" required
                        placeholder="Write your review here..."></textarea>
                    <button type="submit"
                        class="px-4 py-2 mt-2 font-bold text-white bg-green-500 rounded hover:bg-green-700">
                        Submit Review
                    </button>
                </form>
            </div>
            <div class="space-y-4 review-list">
                @forelse ($series->reviews as $review)
                    <div class="p-4 bg-gray-800 rounded-lg shadow">
                        <p class="mb-2 text-gray-300">{{ $review->content }}</p>
                        <p class="text-sm text-gray-500">By: {{ $review->user->name }} on
                            {{ $review->created_at->format('d M Y') }}</p>
                    </div>
                @empty
                    <p class="text-gray-500">No reviews yet.</p>
                @endforelse
            </div>
        </section> 
    </div> --}}
    <script>
        // JS HERE

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
    </script>
@endsection
