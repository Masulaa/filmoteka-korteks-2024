<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;

use App\Models\{Movie, MovieRating};
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Movie\MovieRequest;
use Illuminate\Support\Facades\{Storage};
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    /**
     * Display a listing of the movies.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $movies = Movie::paginate(20);
        return view('movie.home', compact('movies'));
    }


    /**
     * Show the form for creating a new movie.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('movies.create');
    }

    /**
     * Store a newly created movie in storage.
     *
     * @param \App\Http\Requests\Movie\MovieRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MovieRequest $request): RedirectResponse
    {
        $path = $request->file('image') ? $request->file('image')->store('images') : null;

        Movie::create([
            'title' => $request->title,
            'director' => $request->director,
            'release_date' => $request->release_date,
            'rating' => $request->rating,
            'image' => $path,
            'views' => $request->views ?? 0,
        ]);

        return redirect()->route('home')->with('success', 'Movie created successfully.');
    }

    /**
     * Display the specified movie.
     *
     * @param \App\Models\Movie $movie
     * @return \Illuminate\View\View
     */
    public function show(Movie $movie)
    {
        $user = Auth::user();
        $rating = MovieRating::where('movie_id', $movie->id)
            ->where('user_id', $user->id)
            ->first();

        $userRating = $rating ? $rating->rating : 0;
        $averageRating = $movie->averageRating();
        $countRatings = $movie->countRatings();

        return view(
            'movie.movie',
            compact('movie', 'userRating', 'averageRating', 'countRatings')
        );
    }

    /**
     * Show the form for editing the specified movie.
     *
     * @param \App\Models\Movie $movie
     * @return \Illuminate\View\View
     */
    public function edit(Movie $movie): View
    {
        return view('movies.edit', compact('movie'));
    }


    /**
     * Update the specified movie in storage.
     *
     * @param \App\Http\Requests\Movie\MovieRequest
     * @param \App\Models\Movie $movie
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MovieRequest $request, Movie $movie): RedirectResponse
    {

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
            'views' => $request->views ?? 0,
        ]);

        return redirect()->route('home')->with('success', 'Movie updated successfully.');
    }

    /**
     * Remove the specified movie from storage.
     *
     * @param \App\Models\Movie $movie
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Movie $movie): RedirectResponse
    {
        if ($movie->image) {
            Storage::delete($movie->image);
        }

        $movie->delete();

        return redirect()->route('home')->with('success', 'Movie deleted successfully.');
    }


}

