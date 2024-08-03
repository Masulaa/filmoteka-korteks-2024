<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Models\{Movie, MovieRating};
use Illuminate\Http\{JsonResponse, RedirectResponse};
use App\Http\Requests\Movie\MovieRatingRequest;
use Illuminate\Support\Facades\{Auth, Log};

class MovieRatingController extends Controller
{
    /**
     * Remove the specified rating from storage.
     *
     * @param MovieRating $rating
     * @return RedirectResponse
     */
    public function destroy(MovieRating $rating): RedirectResponse
    {
        $rating->delete();
        return redirect()->back()->with('success', 'Rating deleted successfully.');
    }

    /**
     * Store a newly created rating in storage.
     *
     * @param MovieRatingRequest $request
     * @param Movie $movie
     * @return JsonResponse
     */
    public function store(MovieRatingRequest $request, Movie $movie): JsonResponse
    {
        Log::info('Rating store method called', ['user_id' => Auth::id(), 'movie_id' => $movie->id]);

        try {
            $validated = $request->validated();

            Log::info('Validation passed', $validated);

            $rating = MovieRating::updateOrCreate(
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