@extends('layouts.app')

@section('content')
<div id="series-container">
    @include('serie.serieslist', ['serie' => $serie])
</div>
@endsection