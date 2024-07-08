<?php

use Illuminate\Support\Facades\Artisan;
use App\Services\TMDbService;
use Illuminate\Support\Facades\Schedule;

Schedule::command('movies:sync')
            ->dailyAt('03:00');

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

    echo "\033[34m::\033[0m Synchronizing movies urls from GitHub...\n";

    $videoUrls = $tmdbService->fetchVideoUrlsFromGitHub();
    $currentMovieNumber = 1;

    foreach ($videoUrls as $movieTitle => $videoUrl) {
        echo "($currentMovieNumber/".count($videoUrls).") $movieTitle\n";
        $currentMovieNumber++;
    }

    echo "\033[34m::\033[0m Synchronizing movies from TMDb...\n";

    $syncCount = $tmdbService->fetchPopularMovies($videoUrls, $totalMovies);

    $this->info("Successfully synchronized {$syncCount} movies.");
})->purpose('Synchronize movies from TheMovieDB');
