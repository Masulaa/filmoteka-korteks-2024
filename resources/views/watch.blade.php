@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-white">You are watching: {{ $movie->title }}</h1>

        @if ($movie->video_id)
            <div class="text-white">
                <h2>За најбоље искуство користите adblocker као што је <a href="https://ublockorigin.com/" target="_blank" rel="noopener noreferrer" class="underline">uBlock Origin</a></h2>
            </div>

            <div class="embed-responsive embed-responsive-16by9 mt-4">
                <iframe class="embed-responsive-item" src="https://vidsrc.pro/embed/movie/{{ $movie->video_id }}" allowfullscreen
                        allow="autoplay; fullscreen" allowfullscreen="yes" frameborder="no" scrolling="no"
                        style="width: 100%; height: 1000px; overflow: hidden;"></iframe>
            </div>
        @else
            <p class="text-red-500">За сада овај видео је недоступан. Борис је крив</p>
        @endif
    </div>
@endsection
