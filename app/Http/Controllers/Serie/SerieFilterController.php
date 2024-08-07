<?php

namespace App\Http\Controllers\Serie;

use App\Http\Controllers\Controller;

use App\Http\Requests\Serie\SerieFilterRequest;
use App\Models\{Serie};
use Illuminate\Support\Facades\{Log};

class SerieFilterController extends Controller
{
    /**
     * Filter series based on criteria.
     *
     * @param SerieFilterRequest $request
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function filter(SerieFilterRequest $request)
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

            $serie = $query->paginate(20)->appends($request->except("page"));

            if ($request->ajax()) {
                return view("serie.serieslist", compact("serie"))->render();
            }

            return view("serie.home", compact("serie"));
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
