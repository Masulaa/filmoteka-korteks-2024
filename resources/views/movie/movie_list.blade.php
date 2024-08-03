@foreach ($movies as $movie)
    <li>
        <a href="{{ route('movies.show', $movie->id) }}" class="flex gap-2">
        @php
        $imageUrl = "https://image.tmdb.org/t/p/w500/{$movie->image}";
        $fallbackImage = "storage/movies-images/{$movie->image}";
        $imageExists = @getimagesize($imageUrl);
        $displayImage = $imageExists ? $imageUrl : $fallbackImage;
        @endphp
            <img width="56px" src="{{ $displayImage }}">
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
