<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::paginate(20);
        return view('home', compact('movies'));
    }

    public function create()
    {
        return view('movies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'director' => 'required',
            'release_date' => 'required|date',
            'genre' => 'required',
            'rating' => 'required|integer|min:1|max:10',
            'image' => 'nullable|image|max:2048', 
        ]);

        $path = $request->file('image') ? $request->file('image')->store('images') : null;

        Movie::create([
            'title' => $request->title,
            'director' => $request->director,
            'release_date' => $request->release_date,
            'genre' => $request->genre,
            'rating' => $request->rating,
            'image' => $path,
        ]);

        return redirect()->route('movies.index')->with('success', 'Movie created successfully.');
    }

    public function show(Movie $movie)
    {
        return view('movie', ["movie" => $movie]);
    }

    public function edit(Movie $movie)
    {
        return view('movies.edit', compact('movie'));
    }

    public function update(Request $request, Movie $movie)
    {
        $request->validate([
            'title' => 'required',
            'director' => 'required',
            'release_date' => 'required|date',
            'genre' => 'required',
            'rating' => 'required|integer|min:1|max:10',
            'image' => 'nullable|image|max:2048', 
        ]);

        if ($request->file('image')) {
            if ($movie->image) {
                Storage::delete($movie->image); 
            }
            $path = $request->file('image')->store('images');
        } else {
            $path = $movie->image;
        }

        $movie->update([
            'title' => $request->title,
            'director' => $request->director,
            'release_date' => $request->release_date,
            'genre' => $request->genre,
            'rating' => $request->rating,
            'image' => $path,
        ]);

        return redirect()->route('movies.index')->with('success', 'Movie updated successfully.');
    }

    public function destroy(Movie $movie)
    {
        if ($movie->image) {
            Storage::delete($movie->image); 
        }

        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Movie deleted successfully.');
    }
}
