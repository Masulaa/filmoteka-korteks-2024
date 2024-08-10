<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;

use App\Models\{Movie, MovieReview};
use Illuminate\Http\{RedirectResponse};
use App\Http\Requests\Movie\MovieReviewRequest;

class MovieReviewController extends Controller
{
    /**
     * Store a new review for a movie.
     *
     * @param MovieReviewRequest $request
     * @param Movie $movie
     * @return RedirectResponse
     */
    public function store(MovieReviewRequest $request, Movie $movie): RedirectResponse
    {

        $movie->reviews()->create([
            'user_id' => auth()->id(),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('movies.show', $movie->id)->with('success', 'Review added successfully');
    }
}
