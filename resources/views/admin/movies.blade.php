@extends('adminlte::page')

@section('title', 'Admin Dashboard')

@section('content_header')
    <h1>Movies</h1>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Movies</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Director</th>
                        <th>Release Date</th>
                        <th>Genre</th>
                        <!-- <th>Rating</th> -->
                        <th>Image</th>
                        <!-- <th>Overview</th>
                        -->
                        <th>Backdrop Path</th>
                        <th>Trailer Link</th>
                        <th>Video ID</th>
                        <th>Views</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($movies as $movie)
                        <tr>
                            <td>{{ $movie->id }}</td>
                            <td>{{ $movie->title }}</td>
                            <td>{{ $movie->director }}</td>
                            <td>{{ $movie->release_date }}</td>
                            <td>
                                @if ($movie->genres && $movie->genres->isNotEmpty())
                                    @foreach ($movie->genres as $genre)
                                        {{ $genre->name }}{{ !$loop->last ? ',' : '' }}
                                    @endforeach
                                @else
                                    <div style="color: #880000;"> No genres :( </div>
                                @endif
                            </td>
                            <!-- <td>{{ $movie->rating }}</td> -->
                            <td>
                                <a href="{{$movie->image }}">{{$movie->image }}</a>
                            </td>
                            <!-- <td>{{ $movie->overview }}</td> -->
                            <td>
                                <a href="{{ $movie->backdrop_path }}"> {{$movie->backdrop_path}}<a>
                            </td>
                            <td>
                                <a href="https://youtube.com/watch?v={{ $movie->trailer_link }}"> {{$movie->trailer_link}}<a>
                            </td>
                            <td>
                                <a href="https://vidsrc.pro/embed/movie/{{ $movie->video_id }}"> {{$movie->video_id}}<a>
                            </td>
                            <td>{{ $movie->views }}</td>
                            <td>
                                <a href="{{ route('admin.movies.edit', $movie->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('admin.movies.destroy', $movie->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this movie?');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                <a href="{{ route('movies.show', ['movie' => $movie->id]) }}" class="btn btn-info btn-sm">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Create New Movie</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.movies.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Movie Title" required>
                </div>

                <div class="form-group">
                    <label for="director">Director</label>
                    <input type="text" class="form-control" id="director" name="director" placeholder="Director" required>
                </div>

                <div class="form-group">
                    <label for="release_date">Release Date</label>
                    <input type="date" class="form-control" id="release_date" name="release_date" required>
                </div>

                <div class="form-group">
                    <label for="genre">Genre</label>
                    <input type="text" class="form-control" id="genre" name="genre" placeholder="Genre" required>
                </div>

                <!-- <div class="form-group">
                    <label for="rating">Rating</label>
                    <input type="number" step="0.1" class="form-control" id="rating" name="rating" placeholder="Rating" required>
                </div> -->

                <div class="form-group">
                    <label for="image">Upload Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>

                <!-- <div class="form-group">
                    <label for="overview">Overview</label>
                    <textarea id="overview" class="form-control" name="overview" rows="8" placeholder="Movie Overview..." required></textarea>
                </div>

                <div class="form-group">
                    <label for="backdrop_path">Backdrop Path</label>
                    <input type="text" class="form-control" id="backdrop_path" name="backdrop_path" placeholder="Backdrop Path">
                </div> -->

                <div class="form-group">
                    <label for="trailer_link">Trailer Link</label>
                    <input type="url" class="form-control" id="trailer_link" name="trailer_link" placeholder="Trailer Link">
                </div>

                <div class="form-group">
                    <label for="video_id">Video ID</label>
                    <input type="number" class="form-control" id="video_id" name="video_id" placeholder="Video ID">
                </div>

                <div class="form-group">
                    <label for="views">Views</label>
                    <input type="number" class="form-control" id="views" name="views" placeholder="Views">
                </div>

                <button type="submit" class="btn btn-primary">Publish Movie</button>
            </form>
        </div>
    </div>
@endsection
