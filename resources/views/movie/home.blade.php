@extends('layouts.app')

@section('content')
<div id="movies-container">
    @include('movie.movieslist', ['movies' => $movies])
</div>
@endsection