<?php

#use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Services\TMDbService;
use App\Models\Movie;

#Artisan::command('inspire', function () {
#    $this->comment(Inspiring::quote());
#})->purpose('Display an inspiring quote')->hourly();

/*
 * TMDb API изгледа има ограничење од 94 филма по позиву,
 * зато нека се синхронизација врши у више итерација од по 94 филма.
*/

Artisan::command('movies:sync {count}', function ($count) {
    $this->comment("Synchronizing {$count} movies from TMDb...");

    $tmdbService = new TMDbService();

    $requestsNeeded = ceil($count / 94);

    $remainingMovies = $count;

    for ($i = 0; $i < $requestsNeeded; $i++) {
        $moviesToSync = min(94, $remainingMovies); 
        $fetchedCount = $tmdbService->fetchPopularMovies($moviesToSync); 
        $remainingMovies -= $fetchedCount;

        $this->info("Successfully synchronized {$fetchedCount} movies (part " . ($i+1) . "/{$requestsNeeded})");
    }

    $this->info("Finished synchronizing {$count} movies.");
})->purpose('Synchronize movies from TMDb')->daily();