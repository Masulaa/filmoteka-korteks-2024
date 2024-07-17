<div>
    <input wire:model="search" type="text" placeholder="Search movies..." />


    <ul>
        @foreach ($movies as $movie)
            <li>{{ $movie->title }}</li>
        @endforeach
    </ul>


</div>