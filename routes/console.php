<?php

use Illuminate\Support\Facades\Artisan;
use App\Services\TMDbService;

/**
 * Command to synchronize movies from TheMovieDB.
 * @param int|null $count
 * @return void
 */
 
 Artisan::command('movies:sync {count?}', function ($count = null, TMDbService $tmdbService) {
     $tmdbService->fetchPopularMovies($count ?: $tmdbService->getNumberOfAllMovies());
 })->purpose('Synchronize movies from TheMovieDB')->dailyAt("03:00");