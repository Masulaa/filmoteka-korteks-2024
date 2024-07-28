<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TMDbService;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    protected $tmdbService;

    public function __construct(TMDbService $tmdbService)
    {
        $this->tmdbService = $tmdbService;
    }

    public function popularSeries(Request $request)
    {
        $page = $request->input('page', 1);
        $series = $this->tmdbService->fetchSeriesData($page);

        return response()->json($series);
    }
}
