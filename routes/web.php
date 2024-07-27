<?php

use App\Http\Controllers\{
    ProfileController, MovieController, MovieRatingController,
    MovieReviewController, ContactController, MovieFavoriteController,
    SerieController
};
use App\Livewire\MovieSearch;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect('login'));

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/dashboard', 'dashboard.dashboard')->name('dashboard');
    Route::view('/about', 'about.about')->name('about');

    /* MOVIES */
    Route::resource('movies', MovieController::class)->only(['index', 'show']);
    Route::get('/movies/action', [MovieController::class, 'action'])->name('movies.action');
    Route::get('/movies/filter', [MovieController::class, 'filter'])->name('movies.filter');
    Route::get('/movie-search', [MovieSearch::class, 'render'])->name('movie.search');
    Route::get('/movies/{id}/watch', [MovieController::class, 'watch'])->name('movies.watch');
    Route::get('/movies/{id}/watchTrailer', [MovieController::class, 'watchTrailer'])->name('movies.watchTrailer');
    
    Route::post('/movies/{movie}/rate', [MovieRatingController::class, 'store'])->name('movies.rate');
    Route::post('/movies/{movie}/reviews', [MovieReviewController::class, 'store'])->name('reviews.store');

    /* SERIES */
    Route::resource('/series', SerieController::class)->only(['index', 'show']);
    Route::get('/series/action', [SerieController::class, 'action'])->name('series.action');
    Route::get('/series/filter', [SerieController::class, 'filter'])->name('series.filter');
    //Route::get('/series-search', [SerieSearch::class, 'render'])->name('series.search');
    Route::get('/series/{serie}/watch', [SerieController::class, 'watch'])->name('series.watch');
    Route::get('/series/{serie}/watchTrailer', [SerieController::class, 'watchTrailer'])->name('series.watchTrailer');
    

    Route::get('/profile/reviews-ratings/{id}', [ProfileController::class, 'reviewsAndRatings'])->name('profile.reviews-ratings');
    Route::resource('profile', ProfileController::class)->only(['edit', 'update', 'destroy'])
    ->parameters(['profile' => 'id'])
    ->names(['edit' => 'profile.edit','update' => 'profile.update','destroy' => 'profile.destroy']);

    Route::resource('reviews', MovieReviewController::class)->only(['destroy']);
    Route::resource('ratings', MovieRatingController::class)->only(['destroy']);

    Route::resource('contact', ContactController::class)->only(['index', 'store']);
    Route::resource('favorites', MovieFavoriteController::class)->only(['index', 'store', 'destroy']);
});

require __DIR__ . '/auth.php';
