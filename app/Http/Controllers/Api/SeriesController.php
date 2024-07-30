<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TMDbService;
use Illuminate\Http\Request;

class SeriesController extends Controller
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
     * Fetch a list of popular series from the TMDb service and return as JSON response.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function popularSeries(Request $request)
    {
        // Get the current page from the request, default to page 1
        $page = $request->input('page', 1);

        // Fetch series data for the specified page using the TMDb service
        $series = $this->tmdbService->fetchSeriesData($page);

        // Return the series data as a JSON response
        return response()->json($series);
    }
}
