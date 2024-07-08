@extends('layouts.app')

@section('content')
    <div id="movies-container">
        @include('movieslist', ['movies' => $movies])
    </div>
@endsection
