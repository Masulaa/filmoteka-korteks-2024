@extends('adminlte::page')

@section('title', 'Edit serie')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        <h1>Edit serie: {{ $serie->title }}</h1>
        <form action="{{ route('admin.series.update', $serie->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="{{ old('title', $serie->title) }}" required>
            </div>

            <div class="form-group">
                <label for="director">Director</label>
                <input type="text" class="form-control" id="director" name="director"
                    value="{{ old('director', $serie->director) }}" required>
            </div>

            <div class="form-group">
                <label for="release_date">Release Date</label>
                <input type="date" class="form-control" id="release_date" name="release_date"
                    value="{{ old('release_date', $serie->release_date) }}" required>
            </div>

            <div class="form-group">
                <label for="genre">Genre</label>
                <input type="text" class="form-control" id="genre" name="genre"
                    value="{{ old('genre', $serie->genre) }}" required>
            </div>

            <div class="form-group">
                <label for="rating">Rating</label>
                <input type="number" class="form-control" id="rating" name="rating"
                    value="{{ old('rating', $serie->rating) }}" step="0.1" min="0" max="10">
            </div>

            <div class="form-group">
                <label for="trailer_link">Trailer Link</label>
                <input type="url" class="form-control" id="trailer_link" name="trailer_link"
                    value="{{ old('trailer_link', $serie->trailer_link) }}">
            </div>

            <div class="form-group">
                <label for="video_id">Video ID</label>
                <input type="number" class="form-control" id="video_id" name="video_id"
                    value="{{ old('video_id', $serie->video_id) }}">
            </div>

            <div class="form-group">
                <label for="views">Views</label>
                <input type="number" class="form-control" id="views" name="views"
                    value="{{ old('views', $serie->views) }}" min="0">
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control-file" id="image" name="image">
                @if ($serie->image)
                    <img src="{{ asset($serie->image) }}" alt="{{ $serie->title }}"
                        style="max-width: 200px; margin-top: 10px;">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update serie</button>
        </form>
    </div>
@endsection
