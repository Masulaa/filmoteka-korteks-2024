<?php

use Illuminate\Support\Facades\Artisan;
use App\Services\TMDbService;
use Illuminate\Console\Scheduling\Schedule;

/**
 * Command to synchronize movies from TheMovieDB.
 * @param int|null $count
 * @return void
 */

Artisan::command('movies:sync {count?}', function ($count = null) {
    $tmdbService = new TMDbService();
    $tmdbService->fetchPopularMovies($count ?: $tmdbService->getNumberOfAllMovies());
})->purpose('Synchronize movies from TheMovieDB');

app(Schedule::class)->command('movies:sync')->dailyAt('03:00');