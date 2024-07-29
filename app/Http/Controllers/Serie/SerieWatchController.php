<?php


namespace App\Http\Controllers\Serie;

use App\Http\Controllers\Controller;
use App\Models\Serie;
use Illuminate\View\View;

use Illuminate\Http\Request;

class SerieWatchController extends Controller
{

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
