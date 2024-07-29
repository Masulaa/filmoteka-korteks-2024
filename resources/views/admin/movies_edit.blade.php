@extends('adminlte::page')

@section('title', 'Edit Movie')

@section('content_header')
    <h1>Edit Movie</h1>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Movie</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $movie->title) }}" placeholder="Movie Title" required>
                </div>

                <div class="form-group">
                    <label for="director">Director</label>
                    <input type="text" class="form-control" id="director" name="director" value="{{ old('director', $movie->director) }}" placeholder="Director" required>
                </div>

                <div class="form-group">
                    <label for="release_date">Release Date</label>
                    <input type="date" class="form-control" id="release_date" name="release_date" value="{{ old('release_date', $movie->release_date) }}" required>
                </div>

                <div class="form-group">
                    <label for="genre">Genre</label>
                    <input type="text" class="form-control" id="genre" name="genre" value="{{ old('genre', $movie->genre) }}" placeholder="Genre" required>
                </div>

                <!-- <div class="form-group">
                    <label for="rating">Rating</label>
                    <input type="number" step="0.1" class="form-control" id="rating" name="rating" value="{{ old('rating', $movie->rating) }}" placeholder="Rating" required>
                </div> -->

                <div class="form-group">
                    <label for="image">Upload Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @if($movie->image)
                        <img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }}" style="width: 100px; height: auto; margin-top: 10px;">
                    @endif
                </div>

                <!-- <div class="form-group">
                    <label for="overview">Overview</label>
                    <textarea id="overview" class="form-control" name="overview" rows="8" placeholder="Movie Overview..." required>{{ old('overview', $movie->overview) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="backdrop_path">Backdrop Path</label>
                    <input type="text" class="form-control" id="backdrop_path" name="backdrop_path" value="{{ old('backdrop_path', $movie->backdrop_path) }}" placeholder="Backdrop Path">
                </div> -->

                <div class="form-group">
                    <label for="trailer_link">Trailer Link</label>
                    <input type="text" class="form-control" id="trailer_link" name="trailer_link" value="{{ old('trailer_link', $movie->trailer_link) }}" placeholder="Trailer Link">
                </div>

                <div class="form-group">
                    <label for="video_id">Video ID</label>
                    <input type="number" class="form-control" id="video_id" name="video_id" value="{{ old('video_id', $movie->video_id) }}" placeholder="Video ID">
                </div>

                <div class="form-group">
                    <label for="views">Views</label>
                    <input type="number" class="form-control" id="views" name="views" value="{{ old('views', $movie->views) }}" placeholder="Views">
                </div>

                <button type="submit" class="btn btn-primary">Update Movie</button>
            </form>
        </div>
    </div>
@endsection
