<?php

namespace App\Http\Controllers\Serie;

use App\Http\Controllers\Controller;

use App\Models\{Serie, SerieRating};
use Illuminate\Http\{JsonResponse, RedirectResponse};
use App\Http\Requests\Serie\SerieRatingRequest;
use Illuminate\Support\Facades\{Auth, Log};

class SerieRatingController extends Controller
{

    /**
     * Store a newly created rating in storage.
     *
     * @param SerieRatingRequest $request
     * @param Serie $serie
     * @return JsonResponse
     */
    public function store(SerieRatingRequest $request, Serie $serie): JsonResponse
    {
        Log::info("Rating store method called", [
            "user_id" => Auth::id(),
            "serie_id" => $serie->id,
        ]);

        try {
            $validated = $request->validated();

            Log::info("Validation passed", $validated);

            $rating = SerieRating::updateOrCreate(
                [
                    "user_id" => Auth::id(),
                    "serie_id" => $serie->id,
                ],
                ["rating" => $validated["rating"]]
            );

            Log::info("Rating saved", ["rating_id" => $rating->id]);

            return response()->json([
                "success" => true,
                "average_rating" => $serie->averageRating(),
                "message" => "Rating saved successfully",
            ]);
        } catch (\Exception $e) {
            Log::error("Error in rating store method", [
                "error" => $e->getMessage(),
                "user_id" => Auth::id(),
                "serie_id" => $serie->id,
            ]);

            return response()->json(
                [
                    "success" => false,
                    "message" => "An error occurred while saving the rating",
                ],
                500
            );
        }
    }
}
