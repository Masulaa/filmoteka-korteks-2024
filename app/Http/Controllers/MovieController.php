<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::paginate(20);
        return view('home', compact('movies'));
    }
    public function action(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');

            $movies = Movie::where('title', 'like', '%' . $query . '%')
                ->orWhere('director', 'like', '%' . $query . '%')
                ->orWhere('genre', 'like', '%' . $query . '%')
                ->orderBy('id', 'desc')
                ->take(5)
                ->get();

            $total_row = $movies->count();

            if ($total_row > 0) {
                foreach ($movies as $movie) {
                    //add href so when i click on movie it redirects me to movies/id
                    $output .= '
                    <li >
                        <a href="' . route('movie', $movie->id) . '" class="flex gap-2">
                                <img width="56px " src="' . $movie->image . '" >
                                <div class="flex flex-col">
                                    <h1 class="text-lg font-bold">' . $movie->title . '</h1>
                                    <span>' . $movie->director . ' | ' . $movie->release_date . '</span>
                                    <span>' . '</span>
                                </div>
                        </a>
                    </li>';
                }
            } else {
                $output = '
                <tr>
                    <td colspan="3">No movies found</td>
                </tr>';
            }

            $data = array(
                'html' => $output,
                'total' => $total_row
            );

            return response()->json($data);
        }
    }

    public function create()
    {
        return view('movies.create');
    }
    public function filter(Request $request)
    {
        try {
            $query = Movie::query();

            if ($request->filled('genre')) {
                $query->where('genre', 'like', '%' . $request->genre . '%');
            }

            if ($request->filled('min_year') && $request->filled('max_year')) {
                $query->whereYear('release_date', '>=', $request->min_year)
                    ->whereYear('release_date', '<=', $request->max_year);
            }

            $movies = $query->paginate(20)->appends($request->except('page'));

            if ($request->ajax()) {
                return view('movieslist', compact('movies'))->render();
            }

            return view('home', compact('movies'));
        } catch (\Exception $e) {
            Log::error('Movie filter error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'An error occurred while filtering movies: ' . $e->getMessage()], 500);
        }
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

    public function rate(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $movie = Movie::findOrFail($id);

        $rating = new Rating([
            'rating' => $request->input('rating'),
            'user_id' => auth()->id(),
        ]);

        $movie->ratings()->save($rating);

        return redirect()->back()->with('success', 'Rating submitted successfully!');
    }


    public function show(Movie $movie, $id)
    {
        $movie = Movie::find($id);
        $user = Auth::user();
        $rating = Rating::where('movie_id', $movie->id)
            ->where('user_id', $user->id)
            ->first();

        $userRating = $rating ? $rating->rating : 0;
        $averageRating = $movie->averageRating();
        $countRatings = $movie->countRatings();
        return view('movie', compact('movie', 'userRating', 'averageRating', 'countRatings'));
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
    public function watch($id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            abort(404);
        }

        return view('watch', compact('movie'));
    }
}
