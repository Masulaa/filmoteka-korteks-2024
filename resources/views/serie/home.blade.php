@extends('layouts.app')

@section('content')
<div id="series-container">
    @include('serie.serieslist', ['series' => $series])
</div>
@endsection
