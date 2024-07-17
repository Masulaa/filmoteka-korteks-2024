<?php

namespace App\Livewire;

use App\Services\TMDbService;
use Livewire\Component;
use App\Models\Movie;

class MovieSearch extends Component
{
    public $search = '';

    public function render()
    {
        $movies = Movie::where('title', 'like', '%' . $this->search . '%')->get();

        return view('livewire.movie-search', [
            'movies' => $movies,
        ]);
    }
}