<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Models\MovieCast;
use Illuminate\Http\Request;

class MovieCastController extends Controller
{
    /**
     * Display a listing of all movie cast members.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Retrieve all cast members from the database
        $castMembers = MovieCast::all();
        
        // Return the cast members as a JSON response
        return response()->json($castMembers);
    }

    /**
     * Store a newly created movie cast member in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'name' => 'required|string',
            'character' => 'required|string',
            'profile_path' => 'nullable|string',
            'actor_id' => 'nullable|exists:actors,id',
        ]);

        // Create a new movie cast member with the validated data
        $castMember = MovieCast::create($validatedData);
        
        // Return the created cast member as a JSON response with HTTP status 201
        return response()->json($castMember, 201);
    }

    /**
     * Display the specified movie cast member.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        // Find the cast member by ID or fail if not found
        $castMember = MovieCast::findOrFail($id);
        
        // Return the cast member as a JSON response
        return response()->json($castMember);
    }

    /**
     * Update the specified movie cast member in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        // Find the cast member by ID or fail if not found
        $castMember = MovieCast::findOrFail($id);

        // Update the cast member with the request data
        $castMember->update($request->all());
        
        // Return the updated cast member as a JSON response with HTTP status 200
        return response()->json($castMember, 200);
    }

    /**
     * Remove the specified movie cast member from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        // Find the cast member by ID or fail if not found, then delete it
        MovieCast::findOrFail($id)->delete();
        
        // Return a 204 No Content response indicating successful deletion
        return response()->json(null, 204);
    }
}
