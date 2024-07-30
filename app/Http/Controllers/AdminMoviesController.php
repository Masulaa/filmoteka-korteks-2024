<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\User;

class AdminMoviesController extends Controller
{
    /**
     * Display a listing of all movies in the admin panel.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Ensure the user is an admin before proceeding
        $this->checkAdmin($request);

        // Retrieve all movies from the database
        $movies = Movie::all();
        
        // Return the view for listing movies with the movies data
        return view('admin.movies', compact('movies'));
    }

    /**
     * Show the form for creating a new movie.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        // Ensure the user is an admin before proceeding
        $this->checkAdmin($request);

        // Return the view for creating a new movie
        return view('admin.movies-create');
    }

    /**
     * Store a newly created movie in the database.
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
            // 'genre_ids' => 'required|string',
            // 'rating' => 'required|numeric|min:0|max:10',
            'image' => 'nullable|image|max:2048',
             // 'overview' => 'required|string',
            // 'backdrop_path' => 'nullable|string|max:255',
            'trailer_link' => 'nullable|url',
            'video_id' => 'nullable|integer',
            'views' => 'nullable|integer|min:0',
        ]);

        // Create a new movie instance with the validated data
        $movie = new Movie($request->all());

        // Handle file upload for the movie image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/movies');
            $movie->image = $imagePath;
        }

        // Save the new movie to the database
        $movie->save();

        // Redirect to the movies index with a success message
        return redirect()->route('admin.movies.index')->with('success', 'Movie created successfully');
    }

    /**
     * Display the specified movie details.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show(Request $request, $id)
    {
        // Ensure the user is an admin before proceeding
        $this->checkAdmin($request);

        // Find the movie by ID or fail if not found
        $movie = Movie::findOrFail($id);
        
        // Return the view for showing movie details
        return view('admin.movies-show', compact('movie'));
    }

    /**
     * Show the form for editing the specified movie.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Find the movie by ID or fail if not found
        $movie = Movie::findOrFail($id);
        
        // Return the view for editing the movie
        return view('admin.movies_edit', compact('movie'));
    }

    /**
     * Update the specified movie in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Ensure the user is an admin before proceeding
        $this->checkAdmin($request);

        // Find the movie by ID or fail if not found
        $movie = Movie::findOrFail($id);

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

        // Update the movie with the validated data
        $movie->fill($validatedData);

        // Handle file upload for the movie image
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($movie->image && file_exists(public_path('storage/' . $movie->image))) {
                unlink(public_path('storage/' . $movie->image));
            }

            // Store the new image
            $path = $request->file('image')->store('public/movies');
            $movie->image = basename($path);
        }

        // Save the updated movie to the database
        $movie->save();

        // Redirect to the movies index with a success message
        return redirect()->route('admin.movies.index')->with('success', 'Movie updated successfully');
    }

    /**
     * Remove the specified movie from the database.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        // Ensure the user is an admin before proceeding
        $this->checkAdmin($request);

        // Find the movie by ID or fail if not found
        $movie = Movie::findOrFail($id);
        
        // Delete the movie from the database
        $movie->delete();

        // Redirect to the movies index with a success message
        return redirect()->route('admin.movies.index')->with('success', 'Movie deleted successfully');
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
