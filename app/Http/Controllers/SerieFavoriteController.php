<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User, SerieFavorite};
use Illuminate\Support\Facades\Auth;
//use App\Models\Serie;

class SerieFavoriteController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            "user_id" => "required|exists:users,id",
            "serie_id" => "required|exists:series,id",
        ]);

        $user = User::find($request->user_id);
        $serieId = $request->serie_id;

        if (!$user->favoriteSeries()->where("serie_id", $serieId)->exists()) {
            $user->favoriteSeries()->attach($serieId);
            return response()->json(
                ["message" => "Serie added to favorites"],
                201
            );
        } else {
            return response()->json(
                ["message" => "Serie is already in favorites"],
                200
            );
        }
    }
    public function index()
    {
        $user = Auth::user();
        $favoriteSeries = $user->favoriteSeries()->get();

        return view("favorites.series", compact("favoriteSeries"));
    }
    public function destroy($id)
    {
        $favorite = SerieFavorite::where("serie_id", $id)
            ->where("user_id", auth()->id())
            ->first();

        if (!$favorite) {
            return response()->json(
                [
                    "message" => "Favorite serie not found.",
                    "success" => false,
                ],
                404
            );
        }

        $favorite->delete();

        return response()->json(
            [
                "message" => "Serie removed from favorites.",
                "success" => true,
            ],
            200
        );
    }
}
