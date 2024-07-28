<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Serie;

class SerieSearch extends Component
{
    public $search = '';

    public function render()
    {
        $series = Serie::where('title', 'like', '%' . $this->search . '%')->take(10)->get();

        return view('livewire.series-search', [
            'series' => $series,
        ]);
    }
}