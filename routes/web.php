<?php

use App\Http\Controllers\{ProfileController, MovieController, RatingController, ReviewController, ContactController, FavoriteController};
use App\Livewire\MovieSearch;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect('login'));

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/dashboard', 'dashboard.dashboard')->name('dashboard');
    Route::view('/about', 'about.about')->name('about');

    Route::get('/movies', [MovieController::class, 'index'])->name('home');
    Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movie');
    Route::get('/action', [MovieController::class, 'action'])->name('action');
    Route::get('/filter', [MovieController::class, 'filter'])->name('movies.filter');
    Route::get('/movie-search', [MovieSearch::class, 'render'])->name('movie.search');
    Route::get('/movies/{id}/watch', [MovieController::class, 'watch'])->name('movies.watch');
    Route::get('/movies/{id}/watchTrailer', [MovieController::class, 'watchTrailer'])->name('movies.watchTrailer');
    Route::post('/movies/{movie}/rate', [RatingController::class, 'store'])->name('movies.rate');
    Route::post('/movies/{movie}/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    Route::get('/profile/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/reviews-ratings/{id}', [ProfileController::class, 'reviewsAndRatings'])->name('profile.reviews-ratings');

    Route::resource('reviews', ReviewController::class)->only(['destroy']);
    Route::resource('ratings', RatingController::class)->only(['destroy']);

    Route::resource('contact', ContactController::class)->only(['index', 'store']);
    Route::resource('favorites', FavoriteController::class)->only(['index', 'store', 'destroy']);
});

require __DIR__ . '/auth.php';