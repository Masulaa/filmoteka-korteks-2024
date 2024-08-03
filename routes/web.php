<?php

use App\Http\Controllers\{
    ContactController,
    AdminController,
    AdminMoviesController,
    AdminUsersController,
    AdminSeriesController,
    Profile\ProfileController,
    Profile\ProfileReviewsAndRatingsController,
    Serie\SerieController,
    Serie\SerieReviewController,
    Serie\SerieRatingController,
    Serie\SerieFilterController,
    Serie\SerieFavoriteController,
    Serie\SerieWatchController,
    Movie\MovieController,
    Movie\MovieReviewController,
    Movie\MovieRatingController,
    Movie\MovieFavoriteController,
    Movie\MovieWatchController,
    Movie\MovieFilterController,
};

use App\Livewire\{MovieSearch, SerieSearch};
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect('login'));

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/dashboard', 'dashboard.dashboard')->name('dashboard');
    Route::view('/about', 'about.about')->name('about');

    /* MOVIES */
    Route::resource('movies', MovieController::class)->only(['index', 'show']);
    //Route::get('/movies/action', [MovieController::class, 'action'])->name('movies.action');
    //Route::get('/movies/filter', [MovieController::class, 'filter'])->name('movies.filter');
    Route::get('/movies-filter', [MovieFilterController::class, 'filter'])->name('movies.filter');
    Route::get('/movie-search', [MovieSearch::class, 'render'])->name('movie.search');
    Route::get('/movies/{id}/watch', [MovieWatchController::class, 'watch'])->name('movies.watch');
    Route::get('/movies/{id}/watchTrailer', [MovieWatchController::class, 'watchTrailer'])->name('movies.watchTrailer');
    Route::post('/movies/{movie}/rate', [MovieRatingController::class, 'store'])->name('movies.rate');
    Route::post('/movies/{movie}/reviews', [MovieReviewController::class, 'store'])->name('movies.reviews.store');

    /* SERIES */
    Route::resource('series', SerieController::class)->only(['index', 'show']);
    Route::get('/series-filter', [SerieFilterController::class, 'filter'])->name('series.filter');
    Route::get('/series-search', [SerieSearch::class, 'render'])->name('series.search');
    Route::get('/series/{serie}/watch', [SerieWatchController::class, 'watch'])->name('series.watch');
    Route::get('/series/{serie}/watchTrailer', [SerieWatchController::class, 'watchTrailer'])->name('series.watchTrailer');
    Route::post('/series/{serie}/rate', [SerieRatingController::class, 'store'])->name('series.rate');
    Route::post('/series/{serie}/reviews', [SerieReviewController::class, 'store'])->name('series.reviews.store');

    /* PROFILE */
    Route::get('/profile/reviews-ratings/{id}', [ProfileReviewsAndRatingsController::class, 'reviewsAndRatings'])->name('profile.reviews-ratings');
    Route::resource('profile', ProfileController::class)->only(['edit', 'update', 'destroy'])->parameters(['profile' => 'id'])->names(['edit' => 'profile.edit', 'update' => 'profile.update', 'destroy' => 'profile.destroy']);

    /* ADMIN PANEL */
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

        // Movies
        Route::resource('movies', AdminMoviesController::class)->names([
            'index' => 'admin.movies.index',
            'create' => 'admin.movies.create',
            'store' => 'admin.movies.store',
            'show' => 'admin.movies.show',
            'edit' => 'admin.movies.edit',
            'update' => 'admin.movies.update',
            'destroy' => 'admin.movies.destroy',
        ]);

        // Series
        Route::resource('series', AdminSeriesController::class)->names([
            'index' => 'admin.series.index',
            'create' => 'admin.series.create',
            'store' => 'admin.series.store',
            'show' => 'admin.series.show',
            'edit' => 'admin.series.edit',
            'update' => 'admin.series.update',
            'destroy' => 'admin.series.destroy',
        ]);

        // Users
        Route::get('users', [AdminUsersController::class, 'index'])->name('admin.users.index');
        Route::post('users', [AdminUsersController::class, 'store'])->name('admin.users.store');
        Route::delete('users/{id}', [AdminUsersController::class, 'destroy'])->name('admin.users.destroy');
        Route::post('users/{id}/set-admin', [AdminUsersController::class, 'setAdmin'])->name('admin.users.setadmin');
        Route::post('users/{id}/remove-admin', [AdminUsersController::class, 'removeAdmin'])->name('admin.users.removeadmin');
        Route::get('users/{id}/edit', [AdminUsersController::class, 'editUser'])->name('admin.users.edit');
        Route::put('users/{id}/update', [AdminUsersController::class, 'updateUser'])->name('admin.users.update');

    });

    Route::resource('reviews', MovieReviewController::class)->only(['destroy']);
    Route::resource('ratings', MovieRatingController::class)->only(['destroy']);

    Route::resource('contact', ContactController::class)->only(['index', 'store']);
    Route::resource('movie-favorites', MovieFavoriteController::class)->only(['index', 'store', 'destroy']);
    Route::resource('serie-favorites', SerieFavoriteController::class)->only(['index', 'store', 'destroy']);
});

require __DIR__ . '/auth.php';
