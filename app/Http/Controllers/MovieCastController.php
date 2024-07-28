<?php

namespace App\Http\Controllers;

use App\Models\MovieCast;
use Illuminate\Http\Request;

class MovieCastController extends Controller
{
    public function index()
    {
        $castMembers = MovieCast::all();
        return response()->json($castMembers);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'name' => 'required|string',
            'character' => 'required|string',
            'profile_path' => 'nullable|string',
            'actor_id' => 'nullable|exists:actors,id',
        ]);
    
        $castMember = MovieCast::create($validatedData);
        return response()->json($castMember, 201);
    }
    

    public function show($id)
    {
        $castMember = MovieCast::findOrFail($id);
        return response()->json($castMember);
    }

    public function update(Request $request, $id)
    {
        $castMember = MovieCast::findOrFail($id);
        $castMember->update($request->all());
        return response()->json($castMember, 200);
    }

    public function destroy($id)
    {
        MovieCast::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
