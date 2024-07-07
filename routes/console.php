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

Artisan::command('movies:sync', function () {
    $this->comment("Synchronizing movies from TMDb...");

    $tmdbService = new TMDbService();

    // Приказаће се само филмови који су додати на ову листу. 
    // Уколико треба да стоји линк а немамо видео оставите празан стринг 

    $videoUrls = [
        'Inside Out 2' => 'https://81u6xl9d.xyz/e/rhtx5mjiglep/?t=4xjSCfYnDFIIzQ%3D%3D&amp;sub.info=https%3A%2F%2Ffmovies24.to%2Fajax%2Fepisode%2Fsubtitles%2F360844&amp;autostart=true',
        'Furiosa: A Mad Max Saga' => "",
        "Look Who's Back" => 'https://81u6xl9d.xyz/e/ye83nb830cs2/?t=4xjSCfYkBVUKxQ%3D%3D&sub.info=https%3A%2F%2Ffmovies24.to%2Fajax%2Fepisode%2Fsubtitles%2F154234&autostart=true',
    ];

    $count = count($videoUrls);

    $syncCount = $tmdbService->fetchPopularMovies($count, $videoUrls);

    $this->info("Successfully synchronized {$syncCount} movies.");

})->purpose('Synchronize movies with video URLs')->daily();
