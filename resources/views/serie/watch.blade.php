
@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-3xl font-bold tracking-tight ml-10 mt-4 text-white text-center">{{ $serie->title }}</h1>
    @if ($serie->video_id && $serie->episodes->isNotEmpty())
        <div class="relative pt-[56.25%] mt-4 mb-4 w-[80%] mx-auto" style="position: relative; padding-top: 56.25%;">
            <iframe
                id="videoPlayer"
                src="https://vidsrc.pro/embed/tv/{{ $serie->video_id }}/1/1"
                allowfullscreen
                allow="autoplay; fullscreen"
                frameborder="no"
                scrolling="no"
                class="absolute top-0 left-0 w-full h-full mx-auto">
            </iframe>
        </div>

        <!-- Navigation Buttons for Episodes -->
        <div class="text-white ml-10 mb-4 flex justify-between items-center">
            <button id="prevEpisode" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg">
                &lt; Previous Episode
            </button>
            <button id="nextEpisode" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg">
                Next Episode &gt;
            </button>
        </div>

        <!-- Select Boxes for Seasons and Episodes -->
        <div class="text-white ml-10 mb-4 flex justify-between items-center">
            <div>
                <label for="seasonSelect" class="block mb-2 text-sm font-medium text-white">Select Season</label>
                <select id="seasonSelect" class="px-4 py-2 bg-gray-800 text-white rounded-lg">
                    @foreach ($serie->episodes->groupBy('season_number') as $seasonNumber => $episodes)
                        <option value="{{ $seasonNumber }}">Season {{ $seasonNumber }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="episodeSelect" class="block mb-2 text-sm font-medium text-white">Select Episode</label>
                <select id="episodeSelect" class="px-4 py-2 bg-gray-800 text-white rounded-lg">
                    <!-- Options will be populated by JavaScript -->
                </select>
            </div>
        </div>

        <div class="text-white ml-10 mb-4">
            <div class="flex items-center mt-3">
                <svg class="flex-shrink-0 w-5 h-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                <p class="ml-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ $serie->averageRating() }} ({{ $serie->countRatings() }} ratings)
                </p>
                <ul class="flex flex-row items-center sm:gap-[14px] xs:gap-3 gap-[6px] flex-wrap ml-3">
                    @foreach ($serie->genres as $genre)
                        <li class="px-3 py-1 text-sm text-white transition-all duration-300 bg-gray-800 rounded-full dark:bg-gray-700 hover:bg-gray-700 dark:hover:bg-gray-600">
                            <a href="{{ route('series.filter', ['genre' => $genre->name]) }}">{{ $genre->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <h2>For better experience use ad blocker, e.g. <a href="https://ublockorigin.com/" target="_blank"
                    rel="noopener noreferrer" class="underline">uBlock Origin</a></h2>
        </div>
    @else
        <p class="text-red-500">This video is not available at the moment...</p>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const iframe = document.getElementById('videoPlayer');
    const prevEpisodeButton = document.getElementById('prevEpisode');
    const nextEpisodeButton = document.getElementById('nextEpisode');
    const seasonSelect = document.getElementById('seasonSelect');
    const episodeSelect = document.getElementById('episodeSelect');

    let seasonNumber = 1;
    let episodeNumber = 1;
    const seasons = @json($serie->episodes->groupBy('season_number'));

    function updateIframe() {
        const videoId = '{{ $serie->video_id }}';
        iframe.src = `https://vidsrc.pro/embed/tv/${videoId}/${seasonNumber}/${episodeNumber}`;
    }

    function populateEpisodes() {
        episodeSelect.innerHTML = '';
        seasons[seasonNumber].forEach(episode => {
            const option = document.createElement('option');
            option.value = episode.episode_number;
            option.textContent = `Episode ${episode.episode_number}: ${episode.title}`;
            episodeSelect.appendChild(option);
        });
    }

    seasonSelect.addEventListener('change', function () {
        seasonNumber = parseInt(this.value);
        episodeNumber = 1;
        populateEpisodes();
        updateIframe();
    });

    episodeSelect.addEventListener('change', function () {
        episodeNumber = parseInt(this.value);
        updateIframe();
    });

    prevEpisodeButton.addEventListener('click', function () {
        if (episodeNumber > 1) {
            episodeNumber--;
            episodeSelect.value = episodeNumber;
            updateIframe();
        }
    });

    nextEpisodeButton.addEventListener('click', function () {
        if (episodeNumber < seasons[seasonNumber].length) {
            episodeNumber++;
            episodeSelect.value = episodeNumber;
            updateIframe();
        }
    });

    // Initialize the correct season and episode display
    populateEpisodes();
    updateIframe();
});
</script>
@endsection
