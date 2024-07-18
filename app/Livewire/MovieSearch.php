<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Movie;

class MovieSearch extends Component
{
    public $search = '';

    public function render()
    {
        $movies = Movie::where('title', 'like', '%' . $this->search . '%')->take(10)->get();

        return view('livewire.movie-search', [
            'movies' => $movies,
        ]);
    }
}