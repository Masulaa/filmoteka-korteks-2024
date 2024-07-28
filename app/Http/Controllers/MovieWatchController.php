<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\{Movie};

class MovieWatchController extends Controller
{
    /**
     * Watch the specified movie.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function watch(int $id): View
    {
        $movie = Movie::findOrFail($id);
        $movie->increment('views');
        return view('movie.watch', compact('movie'));
    }

    /**
     * Watch trailer of a movie.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function watchTrailer(int $id): View
    {
        $movie = Movie::findOrFail($id);
        return view('movie.watchTrailer', compact('movie'));
    }
}
