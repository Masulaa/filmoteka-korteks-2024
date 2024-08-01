<?php

namespace App\Http\Controllers\Serie;

use App\Http\Controllers\Controller;
use App\Http\Requests\Serie\SerieReviewRequest;

use App\Models\{Serie, SerieReview};
use Illuminate\Http\{RedirectResponse};

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
     * @param SerieReviewRequest $request
     * @param Serie $serie
     * @return RedirectResponse
     */
    public function store(SerieReviewRequest $request, Serie $serie): RedirectResponse
    {
        $serie->reviews()->create([
            "user_id" => auth()->id(),
            "content" => $request->input("content"),
        ]);

        return redirect()
            ->route("series.show", $serie->id)
            ->with("success", "Review added successfully");
    }
}
