<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminMoviesController extends Controller
{
    /**
     * Display a listing of all movies in the admin panel.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->checkAdmin($request);
        $movies = Movie::all();

        return view('admin.movies.list', compact('movies'));
    }

    /**
     * Show the form for creating a new movie.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $this->checkAdmin($request);

        return view('admin.movies-create');
    }

    /**
     * Store a newly created movie in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->checkAdmin($request);

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

        $movie = new Movie($request->all());

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/movies');
            $movie->image = $imagePath;
        }

        $movie->save();

        return redirect()->route('admin.movies.index')->with('success', 'Movie created successfully');
    }

    /**
     * Display the specified movie details.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show(Request $request, $id)
    {
        $this->checkAdmin($request);

        $movie = Movie::findOrFail($id);

        return view('admin.movies-show', compact('movie'));
    }

    /**
     * Show the form for editing the specified movie.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);

        return view('admin.movies.edit', compact('movie'));
    }

    /**
     * Update the specified movie in the database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->checkAdmin($request);

        $movie = Movie::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'director' => 'required|string|max:255',
            'release_date' => 'required|date',
            'genre' => 'required|string|max:255',
            'trailer_link' => 'nullable|url',
            'video_id' => 'nullable|integer',
            'views' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $movie->fill($validatedData);

        if ($request->hasFile('image')) {
            if ($movie->image && Storage::exists($movie->image)) {
                Storage::delete($movie->image);
            }

            $path = $request->file('image')->store('public/movies-images');

            $movie->image = str_replace('public/movies-images/', '', $path);
        }

        $movie->save();

        return redirect()->route('admin.movies.index')->with('success', 'Movie updated successfully');
    }

    /**
     * Remove the specified movie from the database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        $this->checkAdmin($request);

        $movie = Movie::findOrFail($id);
        $movie->delete();

        return redirect()->route('admin.movies.index')->with('success', 'Movie deleted successfully');
    }

    /**
     * Check if the authenticated user is an admin.
     *
     * @return \App\Models\User
     */
    protected function checkAdmin(Request $request)
    {
        if (! auth()->check()) {
            abort(403, 'Unauthorized action.');
        }

        $user = auth()->user();
        if (! $user->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        return $user;
    }
}
