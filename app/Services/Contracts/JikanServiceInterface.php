<?php

namespace App\Services\Contracts;

interface JikanServiceInterface
{
    public function getTopAnimes(string $category, int $page = 1);
    public function getCurrentSeason();
    public function getAnimesBySeason(int $year, string $season);
    public function getAnimesByGenre(int $id, int $page = 1);
    public function getAnimesBySchedule(string $day);
    public function getAnime(string $id);
    public function getAnimeRecommendations(string $id);
    public function searchAnime(string $query);
}
