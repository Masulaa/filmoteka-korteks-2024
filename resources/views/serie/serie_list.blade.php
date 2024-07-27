@foreach ($series as $serie)
    <li>
        <a href="{{ route('series.index') }}/{{ $serie->id }}" class="flex gap-2">
            <img width="56px" src="{{ $serie->image }}">
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
