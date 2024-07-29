<?php

use App\Http\Controllers\{
    ContactController,
    AdminController,
    AdminMoviesController,
};

use App\Http\Controllers\Profile\{
    ProfileController,
    ProfileReviewsAndRatingsController
};

use App\Http\Controllers\Serie\{
    SerieController,
    SerieReviewController,
    SerieRatingController,
    SerieFilterController,
    SerieFavoriteController,
};

use App\Http\Controllers\Movie\{
    MovieController,
    MovieReviewController,
    MovieRatingController,
    MovieFavoriteController,
    MovieWatchController,
    MovieFilterController,
};

use App\Livewire\{MovieSearch, SerieSearch};
use Illuminate\Support\Facades\Route;

Route::get("/", fn() => redirect("login"));

Route::middleware(["auth", "verified"])->group(function () {
    Route::view("/dashboard", "dashboard.dashboard")->name("dashboard");
    Route::view("/about", "about.about")->name("about");

    /* MOVIES */
    Route::resource("movies", MovieController::class)->only(["index", "show"]);
    //Route::get('/movies/action', [MovieController::class, 'action'])->name('movies.action');
    //Route::get('/movies/filter', [MovieController::class, 'filter'])->name('movies.filter');
    Route::get("/action", [MovieController::class, "action"])->name(
        "movies.action"
    );
    Route::get("/filter", [MovieFilterController::class, "filter"])->name(
        "movies.filter"
    );
    Route::get("/movie-search", [MovieSearch::class, "render"])->name(
        "movie.search"
    );
    Route::get("/movies/{id}/watch", [
        MovieWatchController::class,
        "watch",
    ])->name("movies.watch");
    Route::get("/movies/{id}/watchTrailer", [
        MovieWatchController::class,
        "watchTrailer",
    ])->name("movies.watchTrailer");


    Route::post("/movies/{movie}/rate", [
        MovieRatingController::class,
        "store",
    ])->name("movies.rate");
    Route::post("/movies/{movie}/reviews", [
        MovieReviewController::class,
        "store",
    ])->name("reviews.store");


    /* SERIES */
    Route::resource("series", SerieController::class)->only(["index", "show"]);
    Route::get("/series/action", [SerieController::class, "action"])->name(
        "series.action"
    );
    Route::get("/series/filter", [
        SerieFilterController::class,
        "filter",
    ])->name("series.filter");
    Route::get("/series-search", [SerieSearch::class, "render"])->name(
        "series.search"
    );
    Route::get("/series/{serie}/watch", [
        SerieController::class,
        "watch",
    ])->name("series.watch");
    Route::get("/series/{serie}/watchTrailer", [
        SerieController::class,
        "watchTrailer",
    ])->name("series.watchTrailer");

    Route::post("/series/{serie}/rate", [
        SerieRatingController::class,
        "store",
    ])->name("series.rate");
    Route::post("/series/{serie}/reviews", [
        SerieReviewController::class,
        "store",
    ])->name("reviews.store");

    /* PROFILE */
    Route::get("/profile/reviews-ratings/{id}", [
        ProfileReviewsAndRatingsController::class,
        "reviewsAndRatings",
    ])->name("profile.reviews-ratings");
    Route::resource("profile", ProfileController::class)
        ->only(["edit", "update", "destroy"])
        ->parameters(["profile" => "id"])
        ->names([
            "edit" => "profile.edit",
            "update" => "profile.update",
            "destroy" => "profile.destroy",
        ]);

    /* ADMIN PANEL */



    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/movies', [AdminMoviesController::class, 'index'])->name('admin.movies.index');
    Route::get('/admin/movies/create', [AdminMoviesController::class, 'create'])->name('admin.movies.create');
    Route::post('/admin/movies/store', [AdminMoviesController::class, 'store'])->name('admin.movies.store');
    Route::get('/admin/movies/{id}', [AdminMoviesController::class, 'show'])->name('admin.movies.show');
    Route::get('/admin/movies/{id}/edit', [AdminMoviesController::class, 'edit'])->name('admin.movies.edit');
    Route::put('/admin/movies/{id}', [AdminMoviesController::class, 'update'])->name('admin.movies.update');
    Route::delete('/admin/movies/{id}', [AdminMoviesController::class, 'destroy'])->name('admin.movies.destroy');


    Route::resource("reviews", MovieReviewController::class)->only(["destroy"]);
    Route::resource("ratings", MovieRatingController::class)->only(["destroy"]);

    Route::resource("contact", ContactController::class)->only([
        "index",
        "store",
    ]);
    Route::resource("movie-favorites", MovieFavoriteController::class)->only([
        "index",
        "store",
        "destroy",
    ]);
    Route::resource("serie-favorites", SerieFavoriteController::class)->only([
        "index",
        "store",
        "destroy",
    ]);
});

require __DIR__ . "/auth.php";
