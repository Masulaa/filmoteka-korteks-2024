<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
//use App\Models\Movie;

class FavoriteController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'movie_id' => 'required|exists:movies,id',
        ]);

        $user = User::find($request->user_id);
        $movieId = $request->movie_id;

        if (!$user->favorites()->where('movie_id', $movieId)->exists()) {
            $user->favorites()->attach($movieId);
            return response()->json(['message' => 'Movie added to favorites'], 200);
        } else {
            return response()->json(['message' => 'Movie is already in favorites'], 200);
        }
    }
    public function index()
    {
        $user = Auth::user();
        $favoriteMovies = $user->favorites()->get();

        return view('favorites.index', compact('favoriteMovies'));
    }
}