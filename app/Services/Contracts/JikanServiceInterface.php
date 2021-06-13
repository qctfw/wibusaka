<?php

namespace App\Services\Contracts;

interface JikanServiceInterface
{
    public function getTopAnimes(int $page = 1);
    public function getTopUpcomingAnimes(int $page = 1);
    public function getCurrentSeason();
    public function getAnimesBySeason(int $year, string $season);
    public function getAnime(string $id);
}
