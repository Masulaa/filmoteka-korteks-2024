@extends('adminlte::page')

@section('title', 'Edit Series')

@section('content_header')
    <h1>Edit Series</h1>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Series</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.series.update', $serie->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title"
                        value="{{ old('title', $serie->title) }}" placeholder="Series Title" required>
                </div>

                <div class="form-group">
                    <label for="director">Director</label>
                    <input type="text" class="form-control" id="director" name="director"
                        value="{{ old('director', $serie->director) }}" placeholder="Director" required>
                </div>

                <div class="form-group">
                    <label for="release_date">Release Date</label>
                    <input type="date" class="form-control" id="release_date" name="release_date"
                        value="{{ old('release_date', $serie->release_date) }}" required>
                </div>

                <div class="form-group">
                    <label for="genre">Genre</label>
                    <input type="text" class="form-control" id="genre" name="genre"
                        value="{{ old('genre', $serie->genre) }}" placeholder="Genre" required>
                </div>

                <!-- <div class="form-group">
                        <label for="rating">Rating</label>
                        <input type="number" step="0.1" class="form-control" id="rating" name="rating" value="{{ old('rating', $serie->rating) }}" placeholder="Rating" required>
                    </div> -->

                <div class="form-group">
                    <label for="image">Upload Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @if ($serie->image)
                        <img src="{{ asset('storage/' . $serie->image) }}" alt="{{ $serie->title }}"
                            style="width: 100px; height: auto; margin-top: 10px;">
                    @endif
                </div>

                <!-- <div class="form-group">
                        <label for="overview">Overview</label>
                        <textarea id="overview" class="form-control" name="overview" rows="8" placeholder="Series Overview..." required>{{ old('overview', $serie->overview) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="backdrop_path">Backdrop Path</label>
                        <input type="text" class="form-control" id="backdrop_path" name="backdrop_path" value="{{ old('backdrop_path', $serie->backdrop_path) }}" placeholder="Backdrop Path">
                    </div> -->

                <div class="form-group">
                    <label for="trailer_link">Trailer Link</label>
                    <input type="text" class="form-control" id="trailer_link" name="trailer_link"
                        value="{{ old('trailer_link', $serie->trailer_link) }}" placeholder="Trailer Link">
                </div>

                <div class="form-group">
                    <label for="video_id">Video ID</label>
                    <input type="number" class="form-control" id="video_id" name="video_id"
                        value="{{ old('video_id', $serie->video_id) }}" placeholder="Video ID">
                </div>

                <div class="form-group">
                    <label for="views">Views</label>
                    <input type="number" class="form-control" id="views" name="views"
                        value="{{ old('views', $serie->views) }}" placeholder="Views">
                </div>

                <button type="submit" class="btn btn-primary">Update Series</button>
            </form>
        </div>
    </div>
@endsection
