<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TMDbService;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    // Service for interacting with the TMDb API
    protected $tmdbService;

    /**
     * Constructor to initialize the TMDbService.
     *
     * @param \App\Services\TMDbService $tmdbService
     */
    public function __construct(TMDbService $tmdbService)
    {
        $this->tmdbService = $tmdbService;
    }

    /**
     * Fetch a list of popular movies from the TMDb service and return as JSON response.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function popularMovies(Request $request)
    {
        // Get the current page from the request, default to page 1
        $page = $request->input('page', 1);

        // Fetch movies data for the specified page using the TMDb service
        $movies = $this->tmdbService->fetchMoviesData($page);

        // Return the movies data as a JSON response
        return response()->json($movies);
    }
}
