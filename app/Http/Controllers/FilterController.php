<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{Movie};

use Illuminate\Support\Facades\{Log};

class FilterController extends Controller
{
    /**
     * Filter movies based on criteria.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function filter(Request $request)
    {
        try {
            $query = Movie::query();

            if ($request->filled('genre')) {
                $query->whereHas('genres', function ($q) use ($request) {
                    $q->where('name', $request->genre);
                });
            }

            if ($request->filled('min_year') && $request->filled('max_year')) {
                $query->whereYear('release_date', '>=', $request->min_year)
                    ->whereYear('release_date', '<=', $request->max_year);
            }

            if ($request->filled('most_viewed')) {
                $query->orderBy('views', 'desc');
            }

            if ($request->filled('highest_rated')) {
                $query->withAvg('ratings', 'rating')->orderBy('ratings_avg_rating', 'desc');
            }

            $movies = $query->paginate(20)->appends($request->except('page'));

            if ($request->ajax()) {
                return view('movie.movieslist', compact('movies'))->render();
            }

            return view('movie.home', compact('movies'));
        } catch (\Exception $e) {
            Log::error('Movie filter error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'An error occurred while filtering movies: ' . $e->getMessage()], 500);
        }
    }
}
