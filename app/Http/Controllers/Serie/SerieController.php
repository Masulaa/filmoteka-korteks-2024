<?php

namespace App\Http\Controllers\Serie;

use App\Http\Controllers\Controller;

use App\Models\{Serie, SerieRating};
use Illuminate\Http\{RedirectResponse};
use App\Http\Requests\Serie\SerieRequest;
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
        $serie = Serie::paginate(20);
        return view("serie.home", compact("serie"));
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
     * @param SerieRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SerieRequest $request): RedirectResponse
    {

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

    public function show(Serie $series)
    {

        $user = Auth::user();
        $rating = SerieRating::where("serie_id", $series->id)
            ->where("user_id", $user->id)
            ->first();

        $userRating = $rating ? $rating->rating : 0;
        $averageRating = $series->averageRating();
        $countRatings = $series->countRatings();

        return view(
            "serie.serie",
            compact("series", "userRating", "averageRating", "countRatings")
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
     * @param SerieRequest $request
     * @param \App\Models\Serie $serie
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SerieRequest $request, Serie $serie): RedirectResponse
    {


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
}
