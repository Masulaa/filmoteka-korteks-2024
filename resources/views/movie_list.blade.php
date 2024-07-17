@foreach ($movies as $movie)
    <li>
        <a href="{{ route('movie', $movie->id) }}" class="flex gap-2">
            <img width="56px" src="{{ $movie->image }}">
            <div class="flex flex-col">
                <h1 class="text-lg font-bold">{{ $movie->title }}</h1>
                <span>{{ $movie->director }} | {{ $movie->release_date }}</span>
                <span></span>
            </div>
        </a>
    </li>
@endforeach

@if ($movies->isEmpty())
    <li>
        <span>No movies found</span>
    </li>
@endif