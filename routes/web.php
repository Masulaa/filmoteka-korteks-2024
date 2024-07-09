<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SeriesController;
use Illuminate\Support\Facades\Route;

// Public
Route::get('/', function () {
    return redirect('home');
});

// Private
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/home', [MovieController::class, 'index'])->name('home');
    Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movie');
    Route::get('/action', [MovieController::class, 'action'])->name('action');

    Route::post('/movies/{movie}/rate', [RatingController::class, 'store'])->name('movies.rate')->middleware('auth');
    Route::post('/movies/{movie}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('movies/{id}/watch', 'App\Http\Controllers\MovieController@watch')->name('movies.watch');

    Route::get('/filter', [MovieController::class, 'filter'])->name('movies.filter');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/tv', [SeriesController::class, 'index'])->name('series.home');
    Route::get('/series/{id}', [SeriesController::class, 'show'])->name('series.show');
    Route::get('/series-filter', [SeriesController::class, 'filter'])->name('series.filter');
    Route::get('/series-search', [SeriesController::class, 'action'])->name('series.action');


});

require __DIR__ . '/auth.php';
