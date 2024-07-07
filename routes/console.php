<?php

#use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Services\TMDbService;
use App\Models\Movie;

#Artisan::command('inspire', function () {
#    $this->comment(Inspiring::quote());
#})->purpose('Display an inspiring quote')->hourly();

Artisan::command('movies:sync {count?}', function ($count = null) {
    $tmdbService = new TMDbService();

    if ($count === 'all') {
        $totalMovies = $tmdbService->getNumberOfAllMovies();
    } else {
        $count = (int) $count;
        $totalMovies = $count;
    }

    $confirmation = $this->confirm("This command will download {$totalMovies} movies from TheMovieDB. This may take a long time. Are you sure you want to continue?");
    
    if (!$confirmation) {
        $this->info("Operation cancelled.");
        return;
    }

    $this->comment("Synchronizing movies from TMDb...");

    $videoUrls = $tmdbService->fetchVideoUrlsFromGitHub();

    $syncCount = $tmdbService->fetchPopularMovies($videoUrls, $totalMovies);

    $this->info("Successfully synchronized {$syncCount} movies.");
})->purpose('Synchronize movies from TheMovieDB')->daily();