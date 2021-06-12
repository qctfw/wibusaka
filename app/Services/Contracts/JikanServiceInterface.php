<?php

namespace App\Services\Contracts;

interface JikanServiceInterface
{
    public function getCurrentSeason();
    public function getAnime(string $id);
}
