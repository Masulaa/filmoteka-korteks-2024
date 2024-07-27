<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MoviesController;
use App\Http\Controllers\GenreController;

Route::get('/movies/popular', [MoviesController::class, 'popularMovies']);
#Route::get('/series/popular', [SeriesController::class, 'popularSeries']);
Route::get('/genres/fetch', [GenreController::class, 'fetchGenres']);

Route::fallback(function (Request $request) {
    return response()->json([
        'message' => 'Endpoint not found.'
    ], 404);
});
