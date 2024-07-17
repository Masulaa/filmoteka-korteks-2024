<?php

use Illuminate\Support\Facades\Artisan;
use App\Services\{ TMDbService, MoviesService };

/**
 * Command to synchronize movies from TheMovieDB.
 * @param int|null $count
 * @return void
 */
 
 Artisan::command('movies:sync {count?}', function ( TMDbService $tmdbService, MoviesService $moviesService,$count = null) {
     $tmdbService->fetchPopularMovies($count ?: $moviesService->getNumberOfAllMovies());
 })->purpose('Synchronize movies from TheMovieDB')->dailyAt("03:00");