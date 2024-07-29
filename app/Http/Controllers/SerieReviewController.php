<?php

namespace App\Http\Controllers;

use App\Models\{Serie, SerieReview};
use Illuminate\Http\{RedirectResponse, Request};

class SerieReviewController extends Controller
{
    /**
     * Delete a review.
     *
     * @param SerieReview $review
     * @return RedirectResponse
     */
    public function destroy(SerieReview $review): RedirectResponse
    {
        $review->delete();
        return redirect()
            ->back()
            ->with("success", "Review deleted successfully.");
    }

    /**
     * Store a new review for a serie.
     *
     * @param Request $request
     * @param Serie $serie
     * @return RedirectResponse
     */
    public function store(Request $request, Serie $serie): RedirectResponse
    {
        $request->validate([
            "content" => "required",
        ]);

        $serie->reviews()->create([
            "user_id" => auth()->id(),
            "content" => $request->input("content"),
        ]);

        return redirect()
            ->route("series.show", $serie->id)
            ->with("success", "Review added successfully");
    }
}
