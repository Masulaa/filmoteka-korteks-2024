<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RatingController extends Controller
{
    public function destroy(Rating $rating)
{
    $rating->delete();
    return redirect()->back()->with('success', 'Rating deleted successfully.');
}
    public function store(Request $request, Movie $movie)
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