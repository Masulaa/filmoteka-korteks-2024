<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminSeriesController extends Controller
{
    /**
     * Display a listing of all series in the admin panel.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->checkAdmin($request);
        $series = Serie::all();

        return view('admin.series.list', compact('series'));
    }

    /**
     * Show the form for creating a new series.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $this->checkAdmin($request);

        return view('admin.series-create');
    }

    /**
     * Store a newly created series in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->checkAdmin($request);

        $request->validate([
            'title' => 'required|string|max:255',
            'director' => 'required|string|max:255',
            'release_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'trailer_link' => 'nullable|url',
            'video_id' => 'nullable|integer',
            'views' => 'nullable|integer|min:0',
        ]);

        $serie = new Serie($request->all());

        if ($request->hasFile('image')) {
            if ($serie->image && Storage::exists($serie->image)) {
                Storage::delete($serie->image);
            }

            $path = $request->file('image')->store('public/series-images');

            $serie->image = str_replace('public/series-images/', '', $path);
        }


        $serie->save();

        return redirect()->route('admin.series.index')->with('success', 'Series created successfully');
    }

    /**
     * Display the specified series details.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show(Request $request, $id)
    {
        $this->checkAdmin($request);

        $serie = Serie::findOrFail($id);

        return view('admin.series-show', compact('serie'));
    }

    /**
     * Show the form for editing the specified series.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $serie = Serie::findOrFail($id);

        return view('admin.series.edit', compact('serie'));
    }

    /**
     * Update the specified series in the database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->checkAdmin($request);

        $serie = Serie::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'director' => 'required|string|max:255',
            'release_date' => 'required|date',
            'genre' => 'required|string|max:255',
            'trailer_link' => 'nullable|url',
            'video_id' => 'nullable|integer',
            'views' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $serie->fill($validatedData);

        if ($request->hasFile('image')) {
            if ($serie->image && Storage::exists($serie->image)) {
                Storage::delete($serie->image);
            }

            $path = $request->file('image')->store('public/series-images');

            $serie->image = str_replace('public/series-images/', '', $path);
        }

        $serie->save();

        return redirect()->route('admin.series.index')->with('success', 'Series updated successfully');
    }

    /**
     * Remove the specified series from the database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        $this->checkAdmin($request);

        $serie = Serie::findOrFail($id);

        $serie->delete();

        return redirect()->route('admin.series.index')->with('success', 'Series deleted successfully');
    }

    /**
     * Check if the authenticated user is an admin.
     *
     * @return \App\Models\User
     */
    protected function checkAdmin(Request $request)
    {
        if (!auth()->check()) {
            abort(403, 'Unauthorized action.');
        }

        $user = auth()->user();

        if (!$user->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        return $user;
    }
}
