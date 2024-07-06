<?php

#use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Services\TMDbService;
use App\Models\Movie;

#Artisan::command('inspire', function () {
#    $this->comment(Inspiring::quote());
#})->purpose('Display an inspiring quote')->hourly();

Artisan::command('movies:sync {count?}', function ($count = 10) {
    $count = (int) $count; 

    $this->info("Synchronizing $count movies from TMDb...");

    $tmdbService = new TMDbService();

    $moviesData = $tmdbService->fetchPopularMovies();

    $syncedCount = 0;
    foreach ($moviesData['results'] as $movieData) {
        if ($syncedCount >= $count) {
            break;
        }

        Movie::updateOrCreate(
            ['title' => $movieData['title']],
            [
                'overview' => $movieData['overview'],
                'image' => 'https://image.tmdb.org/t/p/w500' . $movieData['poster_path'], 
                'genre' => implode(', ', $movieData['genre_ids']),
                'director' => 'Unknown', 
                'release_date' => $movieData['release_date'],
            ]
        );
        $syncedCount++;
    }

    $this->info("Successfully synchronized $syncedCount movies!");
})->describe('Sync specified number of movies from TMDb API to local database');