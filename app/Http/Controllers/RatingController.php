<?php

namespace App\Http\Controllers;

use App\Models\{ Movie, Rating };
use Illuminate\Http\{ Request, JsonResponse, RedirectResponse };
use Illuminate\Support\Facades\{ Auth, Log };

class RatingController extends Controller
{
    /**
     * Remove the specified rating from storage.
     *
     * @param Rating $rating
     * @return RedirectResponse
     */
    public function destroy(Rating $rating): RedirectResponse
    {
        $rating->delete();
        return redirect()->back()->with('success', 'Rating deleted successfully.');
    }

    /**
     * Store a newly created rating in storage.
     *
     * @param Request $request
     * @param Movie $movie
     * @return JsonResponse
     */
    public function store(Request $request, Movie $movie): JsonResponse
    {
        Log::info('Rating store method called', ['user_id' => Auth::id(), 'movie_id' => $movie->id]);

        try {
            $validated = $request->validate([
                'rating' => 'required|integer|min:1|max:10',
            ]);

            Log::info('Validation passed', $validated);

            $rating = Rating::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'movie_id' => $movie->id,
                ],
                ['rating' => $validated['rating']]
            );

            Log::info('Rating saved', ['rating_id' => $rating->id]);

            return response()->json([
                'success' => true,
                'average_rating' => $movie->averageRating(),
                'message' => 'Rating saved successfully',
            ]);
        } catch (\Exception $e) {
            Log::error('Error in rating store method', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
                'movie_id' => $movie->id
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while saving the rating',
            ], 500);
        }
    }
}
