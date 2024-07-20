<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MoviesController;

Route::get('/movies/popular', [MoviesController::class, 'popularMovies']);