<?php

namespace App\Services;

use App\Exceptions\JikanException;
use App\Services\Contracts\JikanServiceInterface;
use Illuminate\Support\Facades\Http;

class JikanService implements JikanServiceInterface
{
    private $base_uri;

    public function __construct()
    {
        $this->base_uri = 'https://api.jikan.moe/v3/';
    }

    public function getCurrentSeason()
    {
        $response = Http::acceptJson()->get($this->base_uri . 'season');

        if ($response->failed())
            throw new JikanException();

        $result = $response->json();

        $animes = collect($result['anime'])->where('continuing', false)->where('members', '>', 30000)->values();

        // dump($animes);

        // $mal_ids = $animes->pluck('mal_id');
        return [
            'season_name' => $result['season_name'],
            'season_year' => $result['season_year'],
            'animes' => $animes
        ];
    }
}
