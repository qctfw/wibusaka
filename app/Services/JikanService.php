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

    public function getTopRatedAnimes(int $page = 1)
    {
        $result = $this->requestJikan('top/anime/' . $page);
        
        return $result['top'];
    }

    public function getTopPopularityAnimes(int $page = 1)
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
        $result = $this->requestJikan('season/' . $year . '/' . $season);

        $animes = collect($result['anime'])->where('continuing', false)->where('members', '>', 30000)->values();

        // $mal_ids = $animes->pluck('mal_id');
        return [
            'season_name' => $result['season_name'],
            'season_year' => $result['season_year'],
            'animes' => $animes
        ];
    }

    public function getAnime(string $id)
    {
        $result = $this->requestJikan('anime/' . $id);

        return $result;
    }

    public function searchAnime(string $query)
    {
        $result = $this->requestJikan('search/anime', [
            'q' => $query,
            'limit' => 6,
        ]);

        return $result['results'];
    }

    private function requestJikan(string $uri, array $query = null)
    {
        $uri = ltrim($uri, '/');
        $response = Http::acceptJson()->get($this->base_uri . $uri, $query);

        if ($response->failed())
            throw new JikanException();

        return $response->collect();
    }
}
