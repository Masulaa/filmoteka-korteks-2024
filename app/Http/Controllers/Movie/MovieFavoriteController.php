<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Http\Requests\Movie\MovieFavoriteRequest;
use App\Models\{User, MovieFavorite};
use Illuminate\Support\Facades\Auth;

class MovieFavoriteController extends Controller
{
    /**
     * Store a movie in the user's favorites.
     *
     * @param  \App\Http\Requests\Movie\MovieFavoriteRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(MovieFavoriteRequest $request)
    {

        // Find the user by ID from the request
        $user = User::find($request->user_id);
        $movieId = $request->movie_id;

        // Check if the movie is not already in the user's favorites
        if (!$user->favoriteMovies()->where("movie_id", $movieId)->exists()) {
            // Add the movie to the user's favorites
            $user->favoriteMovies()->attach($movieId);
            // Return a success response with HTTP status 201
            return response()->json(
                ["message" => "Movie added to favorites"],
                201
            );
        } else {
            // Return a message indicating the movie is already in favorites with HTTP status 200
            return response()->json(
                ["message" => "Movie is already in favorites"],
                200
            );
        }
    }

    /**
     * Display a list of the user's favorite movies.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get the currently authenticated user
        $user = Auth::user();
        // Retrieve the user's favorite movies
        $favoriteMovies = $user->favoriteMovies()->get();

        // Return the view with the favorite movies
        return view("favorites.movies", compact("favoriteMovies"));
    }

    /**
     * Remove a movie from the user's favorites.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        // Find the favorite movie entry for the current user and specified movie ID
        $favorite = MovieFavorite::where("movie_id", $id)
            ->where("user_id", auth()->id())
            ->first();

        // If the favorite entry is not found, return a 404 response
        if (!$favorite) {
            return response()->json(
                [
                    "message" => "Favorite movie not found.",
                    "success" => false,
                ],
                404
            );
        }

        // Delete the favorite movie entry
        $favorite->delete();

        // Return a success response with HTTP status 200
        return response()->json(
            [
                "message" => "Movie removed from favorites.",
                "success" => true,
            ],
            200
        );
    }
}
