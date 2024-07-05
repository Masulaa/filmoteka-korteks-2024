<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function rateMovie(Request $request, Movie $movie)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:10',
        ]);

        $user = Auth::user();


        $existingRating = Rating::where('user_id', $user->id)
            ->where('movie_id', $movie->id)
            ->first();

        if ($existingRating) {


            $existingRating->rating = $request->rating;
            $existingRating->save();
        } else {
            // Inače, napravi novu ocenu
            Rating::create([
                'user_id' => $user->id,
                'movie_id' => $movie->id,
                'rating' => $request->rating,
            ]);
        }

        return redirect()->route('movies.show', $movie->id)->with('success', 'Rating submitted successfully.');
    }
}
