@extends('adminlte::page')

@section('title', 'Admin Dashboard')

@section('content_header')
    <h1>Series</h1>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Series</h3>
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
                        <!-- <th>Overview</th> -->
                        <!-- <th>Backdrop Path</th> -->
                        <th>Trailer Link</th>
                        <th>Video ID</th>
                        <th>Views</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($series as $serie)
                        <tr>
                            <td>{{ $serie->id }}</td>
                            <td>{{ $serie->title }}</td>
                            <td>{{ $serie->director }}</td>
                            <td>{{ $serie->release_date }}</td>
                            <td>
                                @if ($serie->genres && $serie->genres->isNotEmpty())
                                    @foreach ($serie->genres as $genre)
                                        {{ $genre->name }}{{ !$loop->last ? ',' : '' }}
                                    @endforeach
                                @else
                                    <div style="color: #880000;"> No genres :( </div>
                                @endif
                            </td>
                            <!-- <td>{{ $serie->rating }}</td> -->
                            <td>
                                <a href="https://image.tmdb.org/t/p/w500/{{ $serie->image }}">{{ $serie->image }}</a>
                            </td>
                            <!-- <td>{{ $serie->overview }}</td> -->
                            <!-- <td>
                                <a href="{{ $serie->backdrop_path }}">{{ $serie->backdrop_path }}</a>
                            </td> -->
                            <td>
                                <a href="https://youtube.com/watch?v={{ $serie->trailer_link }}">{{ $serie->trailer_link }}</a>
                            </td>
                            <td>
                                <a href="https://vidsrc.pro/embed/series/{{ $serie->video_id }}">{{ $serie->video_id }}</a>
                            </td>
                            <td>{{ $serie->views }}</td>
                            <td>
                                <a href="{{ route('admin.series.edit', $serie->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('admin.series.destroy', $serie->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this series?');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                <a href="{{ route('series.show', ['series' => $serie->id]) }}" class="btn btn-info btn-sm">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Card for creating new series -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Create New Series</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.series.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Series Title" required>
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
                    <textarea id="overview" class="form-control" name="overview" rows="8" placeholder="Series Overview..." required></textarea>
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

                <button type="submit" class="btn btn-primary">Publish Series</button>
            </form>
        </div>
    </div>
@endsection
