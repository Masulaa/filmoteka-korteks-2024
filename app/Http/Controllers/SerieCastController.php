<?php

namespace App\Http\Controllers;

use App\Models\SerieCast;
use Illuminate\Http\Request;

class SerieCastController extends Controller
{
    public function index()
    {
        $castMembers = SerieCast::all();
        return response()->json($castMembers);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'serie_id' => 'required|exists:series,id',
            'name' => 'required|string',
            'character' => 'required|string',
            'profile_path' => 'nullable|string',
            'actor_id' => 'nullable|exists:actors,id',
        ]);

        $castMember = SerieCast::create($validatedData);
        return response()->json($castMember, 201);
    }


    public function show($id)
    {
        $castMember = SerieCast::findOrFail($id);
        return response()->json($castMember);
    }

    public function update(Request $request, $id)
    {
        $castMember = SerieCast::findOrFail($id);
        $castMember->update($request->all());
        return response()->json($castMember, 200);
    }

    public function destroy($id)
    {
        SerieCast::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
