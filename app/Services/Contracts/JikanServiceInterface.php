<?php

namespace App\Services\Contracts;

interface JikanServiceInterface
{
    public function getTopRatedAnimes(int $page = 1);
    public function getTopPopularityAnimes(int $page = 1);
    public function getTopUpcomingAnimes(int $page = 1);
    public function getCurrentSeason();
    public function getAnimesBySeason(int $year, string $season);
    public function getAnime(string $id);
    public function searchAnime(string $query);
}
