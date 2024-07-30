<?php

namespace App\Http\Controllers\Serie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, SerieFavorite};
use Illuminate\Support\Facades\Auth;

class SerieFavoriteController extends Controller
{
    /**
     * Store a series in the user's favorites.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validate the request data to ensure user_id and serie_id are provided and valid
        $request->validate([
            "user_id" => "required|exists:users,id",
            "serie_id" => "required|exists:series,id",
        ]);

        // Find the user by ID from the request
        $user = User::find($request->user_id);
        $serieId = $request->serie_id;

        // Check if the series is not already in the user's favorites
        if (!$user->favoriteSeries()->where("serie_id", $serieId)->exists()) {
            // Add the series to the user's favorites
            $user->favoriteSeries()->attach($serieId);
            // Return a success response with HTTP status 201
            return response()->json(
                ["message" => "Serie added to favorites"],
                201
            );
        } else {
            // Return a message indicating the series is already in favorites with HTTP status 200
            return response()->json(
                ["message" => "Serie is already in favorites"],
                200
            );
        }
    }

    /**
     * Display a list of the user's favorite series.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get the currently authenticated user
        $user = Auth::user();
        // Retrieve the user's favorite series
        $favoriteSeries = $user->favoriteSeries()->get();

        // Return the view with the favorite series
        return view("favorites.series", compact("favoriteSeries"));
    }

    /**
     * Remove a series from the user's favorites.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        // Find the favorite series entry for the current user and specified series ID
        $favorite = SerieFavorite::where("serie_id", $id)
            ->where("user_id", auth()->id())
            ->first();

        // If the favorite entry is not found, return a 404 response
        if (!$favorite) {
            return response()->json(
                [
                    "message" => "Favorite serie not found.",
                    "success" => false,
                ],
                404
            );
        }

        // Delete the favorite series entry
        $favorite->delete();

        // Return a success response with HTTP status 200
        return response()->json(
            [
                "message" => "Serie removed from favorites.",
                "success" => true,
            ],
            200
        );
    }
}
