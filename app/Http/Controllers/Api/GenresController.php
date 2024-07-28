<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TMDbService;

class GenresController extends Controller
{
    protected $tmdbService;

    public function __construct(TMDbService $tmdbService)
    {
        $this->tmdbService = $tmdbService;
    }

    public function fetchGenres()
    {
        $genres = $this->tmdbService->fetchGenres();
        return response()->json($genres);
    }
}
