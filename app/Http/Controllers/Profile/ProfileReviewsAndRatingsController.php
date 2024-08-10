<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;

use App\Models\{MovieRating, MovieReview, SerieReview, SerieRating};
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProfileReviewsAndRatingsController extends Controller
{

    /**
     * Display the user's movie reviews and ratings.
     *
     * @return View
     */
    public function movieReviewsAndRatings(): View
    {
        $user = Auth::user();

        $reviews = MovieReview::where('user_id', $user->id)->with('movie')->get();
        $ratings = MovieRating::where('user_id', $user->id)->with('movie')->get();

        return view('profile.movie-reviews-ratings', compact('reviews', 'ratings'));
    }
    /**
     * Display the user's serie reviews and ratings.
     *
     * @return View
     */
    public function serieReviewsAndRatings(): View
    {
        $user = Auth::user();

        $reviews = SerieReview::where('user_id', $user->id)->with('serie')->get();
        $ratings = SerieRating::where('user_id', $user->id)->with('serie')->get();

        return view('profile.serie-reviews-ratings', compact('reviews', 'ratings'));
    }

    /**
     * Remove the Movie rating from storage.
     *
     * @param MovieRating $rating
     * @return RedirectResponse
     */
    public function destroyMovieRating(MovieRating $rating): RedirectResponse
    {
        $rating->delete();
        return redirect()->back()->with('success', 'Rating deleted successfully.');
    }

    /**
     * Delete movie review.
     *
     * @param MovieReview $review
     * @return RedirectResponse
     */
    public function destroyMovieReview(MovieReview $review): RedirectResponse
    {
        $review->delete();
        return redirect()->back()->with('success', 'Review deleted successfully.');
    }

    /**
     * Remove the Serie rating from storage.
     *
     * @param SerieRating $rating
     * @return RedirectResponse
     */
    public function destroySerieRating(SerieRating $rating): RedirectResponse
    {
        $rating->delete();
        return redirect()
            ->back()
            ->with("success", "Rating deleted successfully.");
    }

    /**
     * Delete a serie review.
     *
     * @param SerieReview $review
     * @return RedirectResponse
     */
    public function destroySerieReview(SerieReview $review): RedirectResponse
    {
        $review->delete();
        return redirect()
            ->back()
            ->with("success", "Review deleted successfully.");
    }

}
