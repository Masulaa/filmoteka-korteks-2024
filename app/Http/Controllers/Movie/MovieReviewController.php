<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;

use App\Models\{Movie, MovieReview};
use Illuminate\Http\{RedirectResponse, Request};

class MovieReviewController extends Controller
{
    /**
     * Delete a review.
     *
     * @param MovieReview $review
     * @return RedirectResponse
     */
    public function destroy(MovieReview $review): RedirectResponse
    {
        $review->delete();
        return redirect()->back()->with('success', 'Review deleted successfully.');
    }

    /**
     * Store a new review for a movie.
     *
     * @param Request $request
     * @param Movie $movie
     * @return RedirectResponse
     */
    public function store(Request $request, Movie $movie): RedirectResponse
    {
        $request->validate([
            'content' => 'required',
        ]);

        $movie->reviews()->create([
            'user_id' => auth()->id(),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('movies.show', $movie->id)->with('success', 'Review added successfully');
    }
}
