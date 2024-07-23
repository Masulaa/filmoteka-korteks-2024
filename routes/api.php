<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MoviesController;
use App\Http\Controllers\GenreController;

Route::get('/movies/popular', [MoviesController::class, 'popularMovies']);
Route::get('/genres/fetch', [GenreController::class, 'fetchGenres']); 