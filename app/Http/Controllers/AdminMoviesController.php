<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\User;

class AdminMoviesController extends Controller
{
    public function index(Request $request)
    {
        $this->checkAdmin($request);

        $movies = Movie::all();
        return view('admin.movies', compact('movies'));
    }

    public function create(Request $request)
    {
        $this->checkAdmin($request);

        return view('admin.movies-create');
    }

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

    public function show(Request $request, $id)
    {
        $this->checkAdmin($request);

        $movie = Movie::findOrFail($id);
        return view('admin.movies-show', compact('movie'));
    }

    public function edit(Request $request, $id)
    {
        $this->checkAdmin($request);

        $movie = Movie::findOrFail($id);
        return view('admin.movies-edit', compact('movie'));
    }

    public function update(Request $request, $id)
    {
        $this->checkAdmin($request);

        $movie = Movie::findOrFail($id);

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

        $movie->update($request->all());

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $imageURL = url('images/' . $imageName);
            $movie->image = $imageURL;
        }

        $movie->save();

        return redirect()->route('admin.movies.index')->with('success', 'Movie updated successfully');
    }

    public function destroy(Request $request, $id)
    {
        $this->checkAdmin($request);

        $movie = Movie::findOrFail($id);
        $movie->delete();

        return redirect()->route('admin.movies.index')->with('success', 'Movie deleted successfully');
    }


    protected function checkAdmin(Request $request)
    {
        // Proveri da li je korisnik prijavljen
        if (!auth()->check()) {
            abort(403, 'Unauthorized action.');
        }
    
        $user = auth()->user();
    
        // Proveri da li je korisnik admin
        if (!$user->is_admin) {
            abort(403, 'Unauthorized action.');
        }
    
        return $user;
    }
    

}
