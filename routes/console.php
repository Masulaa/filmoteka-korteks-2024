<?php

use Illuminate\Support\Facades\Artisan;
use App\Services\TMDbService;
use Illuminate\Support\Facades\Schedule;

Schedule::command('movies:sync')
            ->dailyAt('03:00');
Schedule::command('series:sync')
            ->dailyAt('03:30');


Artisan::command('movies:sync {count?}', function ($count = null) {
    $tmdbService = new TMDbService();

    if (is_null($count)) {
        $count = 'all';
    } else {
        $confirmation = $this->confirm("{$count} movies will be downloaded from TheMovieDB. This may take a long time. Are you sure you want to continue?");

        if (!$confirmation) {
            $this->info("Operation cancelled.");
            return;
        }
    }

    if ($count === 'all') {
        $totalMovies = $tmdbService->getNumberOfAllMovies();
    } else {
        $count = (int) $count;
        $totalMovies = $count;
    }

    $syncCount = $tmdbService->fetchPopularMovies($totalMovies);

    $this->info("Successfully synchronized {$syncCount} movies.");
})->purpose('Synchronize movies from TheMovieDB');




Artisan::command('series:sync {count?}', function ($count = null) {
    $tmdbService = new TMDbService();

    if (is_null($count)) {
        $count = 'all';
    } else {
        $confirmation = $this->confirm("{$count} TV series will be downloaded from TheMovieDB. This may take a long time. Are you sure you want to continue?");
        if (!$confirmation) {
            $this->info("Operation cancelled.");
            return;
        }
    }

    if ($count === 'all') {
        $totalSeries = $tmdbService->getNumberOfAllSeries();
    } else {
        $count = (int) $count;
        $totalSeries = $count;
    }

    $syncCount = $tmdbService->fetchPopularSeries($totalSeries);
    $this->info("Successfully synchronized {$syncCount} TV series.");
})->purpose('Synchronize TV series from TheMovieDB');