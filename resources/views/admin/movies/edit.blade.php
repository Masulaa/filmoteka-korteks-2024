@extends('adminlte::page')

@section('title', 'Edit Movie')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        <h1>Edit Movie: {{ $movie->title }}</h1>
        <form action="{{ route('admin.movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="{{ old('title', $movie->title) }}" required>
            </div>

            <div class="form-group">
                <label for="director">Director</label>
                <input type="text" class="form-control" id="director" name="director"
                    value="{{ old('director', $movie->director) }}" required>
            </div>

            <div class="form-group">
                <label for="release_date">Release Date</label>
                <input type="date" class="form-control" id="release_date" name="release_date"
                    value="{{ old('release_date', $movie->release_date) }}" required>
            </div>

            <div class="form-group">
                <label for="genre">Genre</label>
                <input type="text" class="form-control" id="genre" name="genre"
                    value="{{ old('genre', $movie->genre) }}" required>
            </div>

            <div class="form-group">
                <label for="rating">Rating</label>
                <input type="number" class="form-control" id="rating" name="rating"
                    value="{{ old('rating', $movie->rating) }}" step="0.1" min="0" max="10">
            </div>

            <div class="form-group">
                <label for="trailer_link">Trailer Link</label>
                <input type="url" class="form-control" id="trailer_link" name="trailer_link"
                    value="{{ old('trailer_link', $movie->trailer_link) }}">
            </div>

            <div class="form-group">
                <label for="video_id">Video ID</label>
                <input type="number" class="form-control" id="video_id" name="video_id"
                    value="{{ old('video_id', $movie->video_id) }}">
            </div>

            <div class="form-group">
                <label for="views">Views</label>
                <input type="number" class="form-control" id="views" name="views"
                    value="{{ old('views', $movie->views) }}" min="0">
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control-file" id="image" name="image">
                @if ($movie->image)
                    <img src="{{ asset($movie->image) }}" alt="{{ $movie->title }}"
                        style="max-width: 200px; margin-top: 10px;">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update Movie</button>
        </form>
    </div>
@endsection
