<?php

use Illuminate\Support\Facades\Artisan;
use App\Services\TMDbService;
use Illuminate\Support\Facades\Schedule;

Schedule::command('movies:sync')
            ->dailyAt('03:00');

Artisan::command('movies:sync {count?}', function ($count = null) {
    $tmdbService = new TMDbService();
    $count = $count ?: $tmdbService->getNumberOfAllMovies();

    $tmdbService->fetchPopularMovies($count);

})->purpose('Synchronize movies from TheMovieDB');