<?php

namespace App\Http\Controllers\Serie;

use App\Http\Controllers\Controller;

use App\Models\{Serie, SerieRating};
use Illuminate\Http\{Request, JsonResponse, RedirectResponse};
use Illuminate\Support\Facades\{Auth, Log};

class SerieRatingController extends Controller
{
    /**
     * Remove the specified rating from storage.
     *
     * @param SerieRating $rating
     * @return RedirectResponse
     */
    public function destroy(SerieRating $rating): RedirectResponse
    {
        $rating->delete();
        return redirect()
            ->back()
            ->with("success", "Rating deleted successfully.");
    }

    /**
     * Store a newly created rating in storage.
     *
     * @param Request $request
     * @param Serie $serie
     * @return JsonResponse
     */
    public function store(Request $request, Serie $serie): JsonResponse
    {
        Log::info("Rating store method called", [
            "user_id" => Auth::id(),
            "serie_id" => $serie->id,
        ]);

        try {
            $validated = $request->validate([
                "rating" => "required|integer|min:1|max:10",
            ]);

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
