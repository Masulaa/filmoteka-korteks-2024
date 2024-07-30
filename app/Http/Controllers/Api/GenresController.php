<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TMDbService;

class GenresController extends Controller
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
     * Fetch a list of genres from the TMDb service and return as JSON response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetchGenres()
    {
        // Fetch genres using the TMDb service
        $genres = $this->tmdbService->fetchGenres();
        
        // Return the genres as a JSON response
        return response()->json($genres);
    }
}
