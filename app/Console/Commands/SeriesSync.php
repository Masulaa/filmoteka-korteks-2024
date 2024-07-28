<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\{ TMDbService, SeriesService };

class SeriesSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'series:sync {count?} {consoleOutput?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize series from TheMovieDB';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(TMDbService $tmdbService, SeriesService $seriesService)
    {
        $count = $this->argument('count') ?? null;
        $consoleOutput = $this->argument('consoleOutput') ?? true;
        $seriesService->fetchPopularSeries($count ?: $seriesService->getNumberOfAllSeries(), $consoleOutput);
    }
}
