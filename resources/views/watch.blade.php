@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-3xl font-bold tracking-tight ml-10 mt-4 text-white">{{ $movie->title }}</h1>

    @if ($movie->video_id)


        <div class="embed-responsive embed-responsive-16by9 mt-4 mb-4 flex justify-center">
            <iframe class="embed-responsive-item" src="https://vidsrc.pro/embed/movie/{{ $movie->video_id }}"
                allowfullscreen allow="autoplay; fullscreen" allowfullscreen="yes" frameborder="no" scrolling="no"
                style="width: 70rem; height: 33rem; overflow: hidden;"></iframe>
        </div>
        <div class="text-white ml-10 mb-4">
            <h2>For better experience use addblocker, e.g. <a href="https://ublockorigin.com/" target="_blank"
                    rel="noopener noreferrer" class="underline">uBlock Origin</a></h2>
        </div>
    @else
        <p class="text-red-500">This video is not available at the moment...</p>
    @endif
</div>
@endsection