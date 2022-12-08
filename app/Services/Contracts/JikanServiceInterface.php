<?php

namespace App\Services\Contracts;

use Carbon\Carbon;

interface JikanServiceInterface
{
    public function getTopAnimes(string $category, int $page = 1);
    public function getCurrentSeason();
    public function getAnimesBySeason(int $year, string $season);
    public function getAnimesByGenre(int $id, int $page = 1);
    public function getAnimesBySchedule(string $day);
    public function getAnimesByProducer(string $producer_id, int $page = 1);
    public function getAnime(string $id);
    public function getAnimeRecommendations(string $id);
    public function getUpcomingBroadcastAnimes(Carbon $time = null);
    public function searchAnime(string $query);
    public function getProducer(string $id);
}
