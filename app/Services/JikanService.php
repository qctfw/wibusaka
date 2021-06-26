<?php

namespace App\Services;

use App\Exceptions\JikanException;
use App\Services\Contracts\JikanServiceInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

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
        
        return collect($result['top']);
    }

    public function getTopPopularityAnimes(int $page = 1)
    {
        $result = $this->requestJikan('top/anime/' . $page . '/bypopularity');
        
        return collect($result['top']);
    }

    public function getTopUpcomingAnimes(int $page = 1)
    {
        $result = $this->requestJikan('top/anime/' . $page . '/upcoming');
        
        return collect($result['top']);
    }

    public function getCurrentSeason()
    {
        $result = $this->requestJikan('season');

        $animes = collect($result['anime'])->where('continuing', false);

        return [
            'season_name' => $result['season_name'],
            'season_year' => $result['season_year'],
            'animes' => $animes
        ];
    }

    public function getAnimesBySeason(int $year, string $season)
    {
        $result = $this->requestJikan('season/' . $year . '/' . $season);

        $animes = collect($result['anime'])->where('continuing', false);

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

    public function getAnimeRecommendations(string $id)
    {
        $result = $this->requestJikan('anime/' . $id . '/recommendations');

        return collect($result['recommendations'])->take(5);
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

        $cache_key = Str::lower(config('app.name')) . ':jikan:' . Str::replace('/', '-', $uri);
        if ($query)
            $cache_key .= ':' . implode('-', $query);

        $cache_time = Str::contains($uri, 'search') ? now()->addDays(2) : now()->addHours(12);

        $response = Cache::remember($cache_key, $cache_time, function () use ($uri, $query) {
            $response = Http::acceptJson()->get($this->base_uri . $uri, $query);

            if ($response->clientError())
            {
                throw new JikanException($response->status());
            }
            
            return $response->body();
        });

        return collect(json_decode($response, true));
    }
}
