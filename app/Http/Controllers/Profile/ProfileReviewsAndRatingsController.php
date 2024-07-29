<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;

use App\Models\{MovieRating, MovieReview};
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfileReviewsAndRatingsController extends Controller
{

    /**
     * Display the user's reviews and ratings.
     *
     * @return View
     */
    public function reviewsAndRatings(): View
    {
        $user = Auth::user();

        $reviews = MovieReview::where('user_id', $user->id)->with('movie')->get();
        $ratings = MovieRating::where('user_id', $user->id)->with('movie')->get();

        return view('profile.reviews-ratings', compact('reviews', 'ratings'));
    }
}
