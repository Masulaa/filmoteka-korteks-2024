<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TMDbService;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    protected $tmdbService;

    public function __construct(TMDbService $tmdbService)
    {
        $this->tmdbService = $tmdbService;
    }

    public function popularMovies(Request $request)
    {
        $page = $request->input('page', 1);
        $movies = $this->tmdbService->fetchMoviesData($page);

        return response()->json($movies);
    }
}
