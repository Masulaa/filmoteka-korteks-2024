@foreach ($series as $serie)
    <li>
        <a href="{{ route('series.show', $serie->id) }}" class="flex gap-2">
        @php
        $imageUrl = "https://image.tmdb.org/t/p/w500/{$serie->image}";
        $fallbackImage = "storage/series-images/{$serie->image}";
        $imageExists = @getimagesize($imageUrl);
        $displayImage = $imageExists ? $imageUrl : $fallbackImage;
        @endphp
            <img width="56px" src="{{ $displayImage }}">
            <div class="flex flex-col">
                <h1 class="text-lg font-bold">{{ $serie->title }}</h1>
                <span>{{ $serie->director }} | {{ $serie->release_date }}</span>
                <span></span>
            </div>
        </a>
    </li>
@endforeach

@if ($series->isEmpty())
    <li>
        <span>No series found</span>
    </li>
@endif
