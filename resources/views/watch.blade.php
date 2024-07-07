<!-- resources/views/movies/watch.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>You are watching: {{ $movie->title }}</h1>

        @if ($movie->video_link)
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="{{ $movie->video_link }}" allowfullscreen
                allow="autoplay; fullscreen" allowfullscreen="yes" frameborder="no" scrolling="no" 
                style="width: 100%; height: 1000px; overflow: hidden;></iframe>
            </div>
        @else
            <p>За сада овај видео је недоступан. За све проблеме које имате контактирајте Бориса</p>
        @endif
    </div>
@endsection
