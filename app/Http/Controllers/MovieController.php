<?php

namespace App\Http\Controllers;

use App\Models\{Movie, Rating, Genre};
use Illuminate\Http\{Request, JsonResponse, RedirectResponse};
use Illuminate\Support\Facades\{Storage, Log};
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
        return view('home', compact('movies'));
    }
    /**
     * Handle AJAX request for action movies search.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function action(Request $request): JsonResponse
    {
        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');

            $movies = Movie::where('title', 'like', '%' . $query . '%')
                ->orWhere('director', 'like', '%' . $query . '%')
                ->orderBy('id', 'desc')
                ->take(5)
                ->get();

            $total_row = $movies->count();

            if ($total_row > 0) {
                foreach ($movies as $movie) {
                    $output .= '
                    <li>
                        <a href="' . route('movie', $movie->id) . '" class="flex gap-2">
                            <img width="56px" src="' . $movie->image . '">
                            <div class="flex flex-col">
                                <h1 class="text-lg font-bold">' . $movie->title . '</h1>
                                <span>' . $movie->director . ' | ' . $movie->release_date . '</span>
                                <span></span>
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

            $data = [
                'html' => $output,
                'total' => $total_row
            ];

            return response()->json($data);
        }

        return response()->json(['error' => 'Invalid request'], 400);
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



    /**
     * Store a newly created movie in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
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

        return redirect()->route('home')->with('success', 'Movie created successfully.');
    }

    /**
     * Store a new rating for a movie.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function rate(Request $request, int $id): RedirectResponse
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

    /**
     * Display the specified movie.
     *
     * @param \App\Models\Movie $movie
     * @return \Illuminate\View\View
     */
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
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Movie $movie
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Movie $movie): RedirectResponse
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

    /**
     * Watch the specified movie.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function watch(int $id): View
    {
        $movie = Movie::findOrFail($id);

        return view('watch', compact('movie'));
    }
}