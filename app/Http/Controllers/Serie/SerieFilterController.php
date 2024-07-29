<?php

namespace App\Http\Controllers\Serie;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\{Serie};
use Illuminate\Support\Facades\{Log};

class SerieFilterController extends Controller
{
    /**
     * Filter series based on criteria.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function filter(Request $request)
    {
        try {
            $query = Serie::query();

            if ($request->filled("genre")) {
                $query->whereHas("genres", function ($q) use ($request) {
                    $q->where("name", $request->genre);
                });
            }

            if ($request->filled("min_year") && $request->filled("max_year")) {
                $query
                    ->whereYear("release_date", ">=", $request->min_year)
                    ->whereYear("release_date", "<=", $request->max_year);
            }

            if ($request->filled("most_viewed")) {
                $query->orderBy("views", "desc");
            }

            if ($request->filled("highest_rated")) {
                $query
                    ->withAvg("ratings", "rating")
                    ->orderBy("ratings_avg_rating", "desc");
            }

            $series = $query->paginate(20)->appends($request->except("page"));

            if ($request->ajax()) {
                return view("serie.serieslist", compact("series"))->render();
            }

            return view("serie.home", compact("series"));
        } catch (\Exception $e) {
            Log::error("Serie filter error: " . $e->getMessage(), [
                "file" => $e->getFile(),
                "line" => $e->getLine(),
                "trace" => $e->getTraceAsString(),
            ]);
            return response()->json(
                [
                    "error" =>
                        "An error occurred while filtering series: " .
                        $e->getMessage(),
                ],
                500
            );
        }
    }

}
