@extends('layouts.app')

@section('content')
    <div id="series-container">
        @include('series.serieslist', ['series' => $series])
    </div>
@endsection
