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

    public function getTopAnimes(int $page = 1)
    {
        $result = $this->requestJikan('top/anime/' . $page . '/bypopularity');
        
        return $result['top'];
    }

    public function getTopUpcomingAnimes(int $page = 1)
    {
        $result = $this->requestJikan('top/anime/' . $page . '/upcoming');
        
        return $result['top'];
    }

    public function getCurrentSeason()
    {
        $result = $this->requestJikan('season');

        $animes = collect($result['anime'])->where('continuing', false)->where('members', '>', 30000)->values();

        // dump($animes);

        // $mal_ids = $animes->pluck('mal_id');
        return [
            'season_name' => $result['season_name'],
            'season_year' => $result['season_year'],
            'animes' => $animes
        ];
    }

    public function getAnimesBySeason(int $year, string $season)
    {
        
    }

    public function getAnime(string $id)
    {
        $result = $this->requestJikan('anime/' . $id);

        return $result;
    }

    private function requestJikan(string $uri)
    {
        $uri = ltrim($uri, '/');
        $response = Http::acceptJson()->get($this->base_uri . $uri);

        if ($response->failed())
            throw new JikanException();

        return $response->collect();
    }
}
