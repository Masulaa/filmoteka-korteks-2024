<?php

#use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Services\TMDbService;
use App\Models\Movie;

#Artisan::command('inspire', function () {
#    $this->comment(Inspiring::quote());
#})->purpose('Display an inspiring quote')->hourly();

Artisan::command('movies:sync {count}', function ($count) {
    $this->comment("Synchronizing {$count} movies from TMDb...");

    $tmdbService = new TMDbService();
    $fetchedCount = $tmdbService->fetchPopularMovies($count);

    $this->info("Successfully synchronized {$fetchedCount} movies!");
})->purpose('Synchronize movies from TMDb')->daily();
