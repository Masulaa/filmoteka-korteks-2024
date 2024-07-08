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

Artisan::command('movies:json {count}', function ($count) {
    $syncCount = 0;
    $page = 1;
    $nullResponseCount = 0;
    $movies = [];

    $moviesPerPage = 20;
    $totalPages = ceil($count / $moviesPerPage);

    while ($page <= $totalPages) {
        try {
            $response = Http::get('https://api.themoviedb.org/3/movie/popular', [
                'api_key' => env('TMDB_API_KEY'),
                'page' => $page,
            ]);

            $moviesData = $response->json()['results'];

            if (empty($moviesData)) {
                $nullResponseCount++;
                if ($nullResponseCount >= 5) {
                    $this->info("Received null responses 5 times in a row. Stopping synchronization.");
                    break;
                }
                sleep(2);
                continue;
            } else {
                $nullResponseCount = 0;
            }

            foreach ($moviesData as $movieData) {
                if ($syncCount >= $count) {
                    break 2;
                }

                $movieTitle = $movieData['title'];
                $movies[$movieTitle] = "";

                $syncCount++;
            }

        } catch (\Exception $e) {
            $this->error("An error occurred: {$e->getMessage()}");
            sleep(5);
        }

        $page++;
    }

    $jsonContent = json_encode($movies, JSON_PRETTY_PRINT);
    $this->line($jsonContent);

    $this->info("Successfully generated JSON with {$syncCount} movies.");
})->describe('Fetch popular movies from TheMovieDB and display the JSON content in the console');

