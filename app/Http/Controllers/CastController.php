<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use Illuminate\Http\Request;

class CastController extends Controller
{
    public function index()
    {
        $castMembers = Cast::all();
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
    
        $castMember = Cast::create($validatedData);
        return response()->json($castMember, 201);
    }
    

    public function show($id)
    {
        $castMember = Cast::findOrFail($id);
        return response()->json($castMember);
    }

    public function update(Request $request, $id)
    {
        $castMember = Cast::findOrFail($id);
        $castMember->update($request->all());
        return response()->json($castMember, 200);
    }

    public function destroy($id)
    {
        Cast::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
