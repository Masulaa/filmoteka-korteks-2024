<?php

namespace App\Services;

use GuzzleHttp\Exception\GuzzleException;
use App\Models\{Serie, SerieCast, Genre};

class SeriesService
{
    public function __construct(protected TMDbService $tmdbService)
    {
    }

    /**
     * Get the number of all series.
     *
     * @return int
     * @throws GuzzleException
     */
    public function getNumberOfAllSeries(): int
    {
        return $this->tmdbService->fetchData(
            "https://api.themoviedb.org/3/tv/popular",
            ["page" => 1]
        )["total_results"] ?? 0;
    }

    /**
     * Get YouTube trailer ID for the given series.
     *
     * @param int $seriesId
     * @return string|null
     * @throws GuzzleException
     */
    public function getYouTubeTrailerId(int $seriesId): ?string
    {
        $videos =
            $this->tmdbService->fetchData(
                "https://api.themoviedb.org/3/tv/{$seriesId}/videos",
                []
            )["results"] ?? [];

        foreach ($videos as $video) {
            if ($video["site"] === "YouTube" && $video["type"] === "Trailer") {
                return $video["key"];
            }
        }

        return null;
    }

    /**
     * Get the director of the given series.
     *
     * @param int $seriesId
     * @return string
     * @throws GuzzleException
     */
    public function getDirector(int $seriesId): string
    {
        $crew =
            $this->tmdbService->fetchData(
                "https://api.themoviedb.org/3/tv/{$seriesId}/credits",
                []
            )["crew"] ?? [];

        foreach ($crew as $member) {
            if ($member["job"] === "Director") {
                return $member["name"];
            }
        }

        return "unknown director";
    }

    /**
     * Get the cast of the given series.
     *
     * @param int $seriesId
     * @return array
     * @throws GuzzleException
     */
    public function getCast(int $seriesId): array
    {
        $cast = array_slice(
            $this->tmdbService->fetchData(
                "https://api.themoviedb.org/3/tv/{$seriesId}/credits",
                []
            )["cast"] ?? [],
            0,
            10
        );

        return array_map(
            fn($actor) => [
                "name" => $actor["name"],
                "character" => $actor["character"],
                "profile_path" => $this->getUrl($actor["profile_path"], "w185"),
                "id" => $actor["id"],
            ],
            $cast
        );
    }

    /**
     * Get the URL for the given path and size.
     *
     * @param string|null $path
     * @param string $size
     * @return string|null
     */
    private function getUrl(?string $path, string $size): ?string
    {
        return $path ? "https://image.tmdb.org/t/p/{$size}{$path}" : null;
    }

    /**
     * Create or update a series in the database.
     *
     * @param array $seriesData
     * @return void
     */
    public function createOrUpdateSeries(array $seriesData): void
    {
        // Retrieve genres
        $genreIds = $seriesData["genre_ids"] ?? [];

        // Create or update series
        $series = Serie::updateOrCreate(
            ["video_id" => $seriesData["id"]],
            [
                "title" => $seriesData["name"],
                "director" => $this->getDirector($seriesData["id"]),
                "release_date" => isset($seriesData["first_air_date"])
                    ? date("Y-m-d", strtotime($seriesData["first_air_date"]))
                    : null,
                "image" => $this->getUrl($seriesData["poster_path"], "w500"),
                "overview" => $seriesData["overview"] ?? null,
                "backdrop_path" => $this->getUrl(
                    $seriesData["backdrop_path"],
                    "original"
                ),
                "trailer_link" => $this->getYouTubeTrailerId($seriesData["id"]),
                "video_id" => $seriesData["id"],
            ]
        );

        // Sync genres
        $this->syncGenres($series, $genreIds);

        // Sync cast
        $this->syncCast($series, $this->getCast($seriesData["id"]));
    }

    /**
     * Sync genres with the series.
     *
     * @param Serie $series
     * @param array $genreIds
     * @return void
     */
    private function syncGenres(Serie $series, array $genreIds): void
    {
        $existingGenreIds = Genre::whereIn("id", $genreIds)
            ->pluck("id")
            ->toArray();
        $series->genres()->sync($existingGenreIds);
    }

    /**
     * Sync cast with the series.
     *
     * @param Serie $series
     * @param array $castData
     * @return void
     */
    private function syncCast(Serie $series, array $castData): void
    {
        $castEntries = [];
        foreach ($castData as $actorData) {
            $castEntries[] = [
                "serie_id" => $series->id,
                "actor_id" => $actorData["id"],
                "name" => $actorData["name"],
                "character" => $actorData["character"],
                "profile_path" => $actorData["profile_path"],
                "updated_at" => now(),
                "created_at" => now(),
            ];
        }

        SerieCast::upsert(
            $castEntries,
            ["serie_id", "actor_id"],
            ["name", "character", "profile_path"]
        );
    }

    /**
     * Process and synchronize a single series' data.
     *
     * @param array $seriesData The data of the series to process.
     * @param int &$syncCount The count of series synchronized so far.
     * @param int $numberOfSeriesToDownload The total number of series to download.
     * @param int &$skipCount The count of series that were skipped because they already exist in the database.
     * @param int &$newCount The count of new series added to the database.
     * @param bool $consoleOutput
     * @return void
     */
    private function processSeriesData(
        array $seriesData,
        int &$syncCount,
        int $numberOfSeriesToDownload,
        int &$skipCount,
        int &$newCount,
        bool $consoleOutput
    ): void {
        if (Serie::where("title", $seriesData["name"])->exists()) {
            $consoleOutput &&
                printf(
                    "\033[K($syncCount/$numberOfSeriesToDownload) Series '{$seriesData["name"]}' already exists.\033[35m Skip\033[0m.\n"
                );
            $skipCount++;
            return;
        }

        $this->createOrUpdateSeries($seriesData);
        $newCount++;
        $consoleOutput &&
            printf(
                "\033[K($syncCount/$numberOfSeriesToDownload) \033[33mNew\033[0m series '{$seriesData["name"]}' added to the database.\n"
            );
    }

    /**
     * Fetch and synchronize popular series from TMDb.
     *
     * @param int $numberOfSeriesToDownload
     * @param bool $consoleOutput
     * @return void
     * @throws GuzzleException
     */
    public function fetchPopularSeries(
        int $numberOfSeriesToDownload,
        bool $consoleOutput = false
    ): void {
        $consoleOutput &&
            printf("\033[34m::\033[0m Synchronizing series from TMDb...\n");
        $syncCount = $skipCount = $newCount = $page = $progresstmp = 0;
        $totalPages = ceil($numberOfSeriesToDownload / 20);

        while ($page++ < $totalPages) {
            $seriesData = $this->tmdbService->fetchSeriesData($page);
            foreach ($seriesData as $serieData) {
                if ($syncCount >= $numberOfSeriesToDownload) {
                    break 2;
                }
                $syncCount++;
                $progress = floor(
                    ($syncCount / $numberOfSeriesToDownload) * 100
                );
                $bar =
                    str_repeat(" ", floor($progress / 2)) .
                    ($progresstmp = $progresstmp == "c" ? "C" : "c") .
                    str_repeat("•", 50 - floor($progress / 2)); // pacman style
                $this->processSeriesData(
                    $serieData,
                    $syncCount,
                    $numberOfSeriesToDownload,
                    $skipCount,
                    $newCount,
                    $consoleOutput
                );
                $consoleOutput && printf("\033[K[$bar] $progress%%\r");
            }
        }

        $consoleOutput &&
            printf(
                "\033[KSuccessfully synchronized {$syncCount} series.\nSkip: {$skipCount}\nNew: {$newCount}\n"
            );
    }
}
