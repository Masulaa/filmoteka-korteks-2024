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

// Искључиво навести 1 сервер, линк мора бити ка iframe-у који ће емитовати видео.
    // netu.tv
    $videoUrls = [
        "John Wick: Chapter 4" => 'https://netu.filmoviplex.com/e/Qlp1d1NzODRCcHd5L0JLam5xZXlNdz09',
        //"" => '',
    ];
    // Filemoon
    /*
    $videoUrls = [
        "Inside Out 2" => 'https://81u6xl9d.xyz/e/zg3hpv110hbo/?t=4xjSCfYjAF0Ayg%3D%3D&autostart=true',
        "Furiosa: A Mad Max Saga" => 'https://81u6xl9d.xyz/e/rhtx5mjiglep/?t=4xjSCfYiDVQKzg%3D%3D&sub.info=https%3A%2F%2Ffmovies24.to%2Fajax%2Fepisode%2Fsubtitles%2F360844&autostart=true',
        "Look Who's Back" => 'https://81u6xl9d.xyz/e/ye83nb830cs2/?t=4xjSCfYkBVUKxQ%3D%3D&sub.info=https%3A%2F%2Ffmovies24.to%2Fajax%2Fepisode%2Fsubtitles%2F154234&autostart=true',
        "Kingdom of the Planet of the Apes" => 'https://81u6xl9d.xyz/e/eyzzr2vc2rwv/?t=4xjSCfYjAF0NzA%3D%3D&sub.info=https%3A%2F%2Ffmovies24.to%2Fajax%2Fepisode%2Fsubtitles%2F359844&autostart=true',
        "John Wick: Chapter 4" => 'https://81u6xl9d.xyz/e/bftwn8igw5dm/?t=4xjSCfYjA1ALxA%3D%3D&sub.info=https%3A%2F%2Ffmovies24.to%2Fajax%2Fepisode%2Fsubtitles%2F121230&autostart=true',
        "" => '',
    ];
    */

    $syncCount = $tmdbService->fetchPopularMovies($videoUrls, $totalMovies);

    $this->info("Successfully synchronized {$syncCount} movies.");
})->purpose('Synchronize movies from TheMovieDB')->daily();