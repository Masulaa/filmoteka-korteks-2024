<?php

namespace App\Http\Controllers;

use App\Models\{ Movie, Review };
use Illuminate\Http\{ RedirectResponse, Request };

class ReviewController extends Controller
{
    /**
     * Delete a review.
     *
     * @param Review $review
     * @return RedirectResponse
     */
    public function destroy(Review $review): RedirectResponse
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

        return redirect()->route('movie', $movie->id)->with('success', 'Review added successfully');
    }
}