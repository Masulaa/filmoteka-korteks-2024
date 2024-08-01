<?php

namespace App\Http\Controllers\Serie;

use App\Http\Controllers\Controller;
use App\Models\SerieCast;
use App\Http\Requests\Serie\SerieCastRequest;

class SerieCastController extends Controller
{
    /**
     * Display a listing of all series cast members.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Retrieve all cast members for series from the database
        $castMembers = SerieCast::all();

        // Return the cast members as a JSON response
        return response()->json($castMembers);
    }

    /**
     * Store a newly created series cast member in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SerieCastRequest $request)
    {

        // Create a new series cast member with the validated data
        $castMember = SerieCast::create($request->validated());

        // Return the created cast member as a JSON response with HTTP status 201
        return response()->json($castMember, 201);
    }

    /**
     * Display the specified series cast member.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        // Find the cast member by ID or fail if not found
        $castMember = SerieCast::findOrFail($id);

        // Return the cast member as a JSON response
        return response()->json($castMember);
    }

    /**
     * Update the specified series cast member in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SerieCastRequest $request, $id)
    {
        // Find the cast member by ID or fail if not found
        $castMember = SerieCast::findOrFail($id);

        // Update the cast member with the request data
        $castMember->update($request->validated());

        // Return the updated cast member as a JSON response with HTTP status 200
        return response()->json($castMember, 200);
    }

    /**
     * Remove the specified series cast member from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        // Find the cast member by ID or fail if not found, then delete it
        SerieCast::findOrFail($id)->delete();

        // Return a 204 No Content response indicating successful deletion
        return response()->json(null, 204);
    }
}
