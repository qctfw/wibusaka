<?php

namespace App\Services;

use App\Exceptions\JikanException;
use App\Services\Contracts\JikanServiceInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
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
        return $this->getTopAnimes($page);
    }

    public function getTopAiringAnimes(int $page = 1)
    {
        return $this->getTopAnimes($page, 'airing');
    }

    public function getTopPopularityAnimes(int $page = 1)
    {
        return $this->getTopAnimes($page, 'bypopularity');
    }

    public function getTopUpcomingAnimes(int $page = 1)
    {
        return $this->getTopAnimes($page, 'upcoming');
    }

    public function getCurrentSeason()
    {
        $result = $this->requestJikan('season');

        $season_navigation = $this->getSeasonNavigation($result['season_year'], $result['season_name']);

        $animes = collect($result['anime'])->where('continuing', false);

        return [
            'seasons' => $season_navigation,
            'animes' => $animes
        ];
    }

    public function getAnimesBySeason(int $year, string $season)
    {
        $season_navigation = $this->getSeasonNavigation($year, $season);

        $result = $this->requestJikan('season/' . $year . '/' . $season);

        $animes = collect($result['anime'])->where('continuing', false);

        return [
            'seasons' => $season_navigation,
            'animes' => $animes
        ];
    }
    
    public function getAnimesByGenre(int $id, int $page = 1)
    {
        $result = $this->requestJikan('genre/anime/' . $id . '/' . $page);

        return [
            'total' => $result['item_count'],
            'mal_details' => $result['mal_url'],
            'animes' => collect($result['anime'])
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
        $result = $this->requestJikan('search/anime', now()->addDays(5)->endOfDay(), [
            'q' => $query,
            'limit' => 6,
        ]);

        return $result['results'];
    }

    private function requestJikan(string $uri, Carbon $cache_expire = null, array $query = null)
    {
        $uri = trim($uri, '/');

        $cache_key = Str::lower(config('app.name')) . ':jikan:' . Str::replace('/', '-', $uri);

        if ($query)
        {
            $cache_key .= ':' . implode('-', $query);
        }

        if (is_null($cache_expire))
        {
            $cache_expire = now()->addDay()->endOfDay();
        }

        $response = Cache::remember($cache_key, $cache_expire, function () use ($uri, $query) {
            $full_url = $this->base_uri . $uri;

            $this->logJikan($full_url, $query);

            $response = Http::acceptJson()->get($this->base_uri . $uri, $query);

            if ($response->failed())
            {
                $status = $response->status();
                $exception_body = $response->collect();
                $exception_message = 'Type: ' . $exception_body['type'] . ' (' . $exception_body['message'] . ')';

                throw new JikanException($status, $exception_message);
            }
            
            return $response->body();
        });

        return collect(json_decode($response, true));
    }

    private function getTopAnimes(int $page = 1, string $category = '')
    {
        $uri = 'top/anime/' . $page;

        $uri .= (substr($category, 0, 1) == '/') ? $category : '/' . $category;

        $result = $this->requestJikan($uri);

        return collect($result['top']);
    }

    private function getSeasonNavigation(int $year, string $season)
    {
        if (!$this->validateSeason($year, $season))
        {
            throw new JikanException(404);
        }

        $season = ucfirst($season);

        $all_seasons = $this->getAllowedSeasons();
        $current_year_seasons = $all_seasons->get($year);

        $current_season_index = $current_year_seasons->search($season);

        $previous = null;
        if ($current_season_index == 0)
        {
            $previous_seasons = $all_seasons->get($year - 1);

            if (!is_null($previous_seasons))
            {
                $previous['season'] = strtolower($previous_seasons->last());
                $previous['year'] = $year - 1;
            }
        }
        else
        {
            $previous['season'] = strtolower($current_year_seasons[$current_season_index - 1]);
            $previous['year'] = $year;
        }

        $next = null;
        if ($current_season_index == $current_year_seasons->count() - 1)
        {
            $next_seasons = $all_seasons->get($year + 1);
            if (!is_null($next_seasons))
            {
                $next['season'] = strtolower($next_seasons->first());
                $next['year'] = $year + 1;
            }
        }
        else
        {
            $next['season'] = strtolower($current_year_seasons[$current_season_index + 1]);
            $next['year'] = $year;
        }

        return [
            'previous' => $previous,
            'current' => [
                'season' => $season,
                'year' => $year
            ],
            'next' => $next
        ];
    }

    private function getAllowedSeasons()
    {
        $all_seasons = $this->requestJikan('season/archive', now()->addMonth()->endOfMonth());
        return collect($all_seasons['archive'])->mapWithKeys(function ($item, $key) {
            return [ $item['year'] => collect($item['seasons']) ];
        });
    }

    private function validateSeason(int $year, string $season): bool
    {
        $all_seasons = $this->getAllowedSeasons();
        $seasons = $all_seasons->get($year);
        if (is_null($seasons))
        {
            return false;
        }

        return is_integer($seasons->search(ucfirst($season)));
    }

    private function logJikan($full_url, $query)
    {
        if (is_null($query))
        {
            $query = [];
        }

        $log = 'Requesting Jikan... URL: ' . $full_url . ' Query: ' . http_build_query($query);
        Log::info($log);
    }
}
