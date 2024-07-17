<?php

use Illuminate\Support\Facades\Artisan;
use App\Services\{ TMDbService, MoviesService };

/**
 * Command to synchronize movies from TheMovieDB.
 * @param int|null $count
 * @return void
 */
 
 Artisan::command('movies:sync {count?}', function ( TMDbService $tmdbService, MoviesService $moviesService,$count = null) {
     $moviesService->fetchPopularMovies($count ?: $moviesService->getNumberOfAllMovies(), true);
 })->purpose('Synchronize movies from TheMovieDB')->dailyAt("03:00");