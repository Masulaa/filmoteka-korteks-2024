@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-3xl font-bold tracking-tight ml-10 mt-4 text-white">{{ $movie->title }}</h1>
    @if ($movie->video_id)
        <div class="embed-responsive embed-responsive-16by9 mt-4 mb-4 flex justify-center">
          <iframe 
            width="1920" height="1024" src="https://www.youtube.com/embed/{{ $movie -> trailer_link }}"
            frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
        <div class="text-white ml-10 mb-4">
            <div class="flex items-center mt-3">
                <svg class="flex-shrink-0 w-5 h-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                <p class="ml-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ $movie->averageRating() }} ({{ $movie->countRatings() }} ratings)
                </p>
                <ul class="flex flex-row items-center sm:gap-[14px] xs:gap-3 gap-[6px] flex-wrap ml-3 ">
                    @foreach ($movie->genres as $genre)
                        <li class="px-3 py-1 text-sm text-white transition-all duration-300 bg-gray-800 rounded-full dark:bg-gray-700 hover:bg-gray-700 dark:hover:bg-gray-600">
                            <a href="{{ route('movies.filter', ['genre' => $genre->name]) }}">{{ $genre->name }}</a>
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
@endsection