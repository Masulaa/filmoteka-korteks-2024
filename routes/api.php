<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{MoviesController, SeriesController, GenresController, DeployController };

Route::get('/movies/popular', [MoviesController::class, 'popularMovies']);
Route::get('/series/popular', [SeriesController::class, 'popularSeries']);
Route::get('/genres/fetch', [GenresController::class, 'fetchGenres']);

Route::post('/deploy', [DeployController::class, 'deploy'])->name('deploy');

Route::fallback(function (Request $request) {
    return response()->json([
        'message' => 'Endpoint not found.'
    ], 404);
});
