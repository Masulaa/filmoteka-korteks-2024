<?php

namespace App\Http\Controllers;

use App\Models\{Serie, SerieRating};
use Illuminate\Http\{Request, RedirectResponse};
use Illuminate\Support\Facades\{Storage, Log};
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class SerieController extends Controller
{
    /**
     * Display a listing of the series.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $series = Serie::paginate(20);
        return view("serie.home", compact("series"));
    }

    /**
     * Show the form for creating a new serie.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view("series.create");
    }
    /**
     * Store a newly created serie in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            "title" => "required",
            "director" => "required",
            "release_date" => "required|date",
            "rating" => "required|integer|min:1|max:10",
            "image" => "nullable|image|max:2048",
            "views" => "nullable|integer|min:0",
        ]);

        $path = $request->file("image")
            ? $request->file("image")->store("images")
            : null;

        Serie::create([
            "title" => $request->title,
            "director" => $request->director,
            "release_date" => $request->release_date,
            "rating" => $request->rating,
            "image" => $path,
            "views" => $request->views ?? 0,
        ]);

        return redirect()
            ->route("home")
            ->with("success", "Serie created successfully.");
    }

    /**
     * Display the specified serie.
     *
     * @param \App\Models\Serie $serie
     * @return \Illuminate\View\View
     */
    public function show(int $id)
    {
        // If it works, don't touch it
        $serie = Serie::findOrFail($id);

        $user = Auth::user();
        $rating = SerieRating::where("serie_id", $serie->id)
            ->where("user_id", $user->id)
            ->first();

        $userRating = $rating ? $rating->rating : 0;
        $averageRating = $serie->averageRating();
        $countRatings = $serie->countRatings();

        return view(
            "serie.serie",
            compact("serie", "userRating", "averageRating", "countRatings")
        );
    }

    /**
     * Show the form for editing the specified serie.
     *
     * @param \App\Models\Serie $serie
     * @return \Illuminate\View\View
     */
    public function edit(Serie $serie): View
    {
        return view("series.edit", compact("serie"));
    }

    /**
     * Update the specified serie in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Serie $serie
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Serie $serie): RedirectResponse
    {
        $request->validate([
            "title" => "required",
            "director" => "required",
            "release_date" => "required|date",
            "genre" => "required",
            "rating" => "required|integer|min:1|max:10",
            "image" => "nullable|image|max:2048",
            "views" => "nullable|integer|min:0",
        ]);

        if ($request->file("image")) {
            if ($serie->image) {
                Storage::delete($serie->image);
            }
            $path = $request->file("image")->store("images");
        } else {
            $path = $serie->image;
        }

        $serie->update([
            "title" => $request->title,
            "director" => $request->director,
            "release_date" => $request->release_date,
            "genre" => $request->genre,
            "rating" => $request->rating,
            "image" => $path,
            "views" => $request->views ?? 0,
        ]);

        return redirect()
            ->route("home")
            ->with("success", "Serie updated successfully.");
    }

    /**
     * Remove the specified serie from storage.
     *
     * @param \App\Models\Serie $serie
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Serie $serie): RedirectResponse
    {
        if ($serie->image) {
            Storage::delete($serie->image);
        }

        $serie->delete();

        return redirect()
            ->route("home")
            ->with("success", "Serie deleted successfully.");
    }

    /**
     * Watch the specified serie.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function watch(int $id): View
    {
        $serie = Serie::findOrFail($id);
        $serie->increment("views");
        return view("serie.watch", compact("serie"));
    }

    /**
     * Watch trailer of a serie.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function watchTrailer(int $id): View
    {
        $serie = Serie::findOrFail($id);
        return view("serie.watchTrailer", compact("serie"));
    }
}