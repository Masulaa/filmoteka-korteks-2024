<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

});
Route::get('/home', [MovieController::class, 'index'])->name('home');
Route::get('/movie', [MovieController::class, 'show'])->name('movie');
