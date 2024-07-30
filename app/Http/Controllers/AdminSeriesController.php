<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie;
use App\Models\User;

class AdminSeriesController extends Controller
{
    /**
     * Display a listing of all series in the admin panel.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Ensure the user is an admin before proceeding
        $this->checkAdmin($request);

        // Retrieve all series from the database
        $series = Serie::all();
        
        // Return the view for listing series with the series data
        return view('admin.series', compact('series'));
    }

    /**
     * Show the form for creating a new series.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        // Ensure the user is an admin before proceeding
        $this->checkAdmin($request);

        // Return the view for creating a new series
        return view('admin.series-create');
    }

    /**
     * Store a newly created series in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Ensure the user is an admin before proceeding
        $this->checkAdmin($request);

        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'director' => 'required|string|max:255',
            'release_date' => 'required|date',            
            'image' => 'nullable|image|max:2048',
            'trailer_link' => 'nullable|url',
            'video_id' => 'nullable|integer',
            'views' => 'nullable|integer|min:0',
        ]);

        // Create a new series instance with the validated data
        $serie = new Serie($request->all());

        // Handle file upload for the series image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/series');
            $serie->image = $imagePath;
        }

        // Save the new series to the database
        $serie->save();

        // Redirect to the series index with a success message
        return redirect()->route('admin.series.index')->with('success', 'Series created successfully');
    }

    /**
     * Display the specified series details.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show(Request $request, $id)
    {
        // Ensure the user is an admin before proceeding
        $this->checkAdmin($request);

        // Find the series by ID or fail if not found
        $serie = Serie::findOrFail($id);
        
        // Return the view for showing series details
        return view('admin.series-show', compact('serie'));
    }

    /**
     * Show the form for editing the specified series.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Find the series by ID or fail if not found
        $serie = Serie::findOrFail($id);
        
        // Return the view for editing the series
        return view('admin.series_edit', compact('serie'));
    }

    /**
     * Update the specified series in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Ensure the user is an admin before proceeding
        $this->checkAdmin($request);

        // Find the series by ID or fail if not found
        $serie = Serie::findOrFail($id);

        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'director' => 'required|string|max:255',
            'release_date' => 'required|date',
            'genre' => 'required|string|max:255',
            'rating' => 'nullable|numeric|min:0|max:10',
            'trailer_link' => 'nullable|url',
            'video_id' => 'nullable|integer',
            'views' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Update the series with the validated data
        $serie->fill($validatedData);

        // Handle file upload for the series image
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($serie->image && file_exists(public_path('storage/' . $serie->image))) {
                unlink(public_path('storage/' . $serie->image));
            }

            // Store the new image
            $path = $request->file('image')->store('public/series');
            $serie->image = basename($path);
        }

        // Save the updated series to the database
        $serie->save();

        // Redirect to the series index with a success message
        return redirect()->route('admin.series.index')->with('success', 'Series updated successfully');
    }

    /**
     * Remove the specified series from the database.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        // Ensure the user is an admin before proceeding
        $this->checkAdmin($request);

        // Find the series by ID or fail if not found
        $serie = Serie::findOrFail($id);
        
        // Delete the series from the database
        $serie->delete();

        // Redirect to the series index with a success message
        return redirect()->route('admin.series.index')->with('success', 'Series deleted successfully');
    }

    /**
     * Check if the authenticated user is an admin.
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Models\User
     */
    protected function checkAdmin(Request $request)
    {
        // Ensure the user is logged in
        if (!auth()->check()) {
            abort(403, 'Unauthorized action.');
        }
    
        $user = auth()->user();
    
        // Ensure the user is an admin
        if (!$user->is_admin) {
            abort(403, 'Unauthorized action.');
        }
    
        return $user;
    }
}
