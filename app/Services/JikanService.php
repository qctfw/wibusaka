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

    public function getTopAnimes(string $category = '', int $page = 1)
    {
        if ($category == 'rated')
        {
            $category = '';
        }

        $uri = 'top/anime/' . $page;

        $uri .= (Str::substr($category, 0, 1) == '/') ? $category : '/' . $category;

        $result = $this->requestJikan($uri, ['jikan-top', 'jikan-top-' . $category], 'jikan-top-' . $category . '-' . $page);

        return collect($result['top']);
    }

    public function getCurrentSeason()
    {
        $result = $this->requestJikan('season', ['jikan-season'], 'jikan-season-current');

        $season_navigation = $this->getSeasonNavigation($result['season_year'], $result['season_name']);

        $animes = collect($result['anime']);

        return [
            'seasons' => $season_navigation,
            'animes' => $animes
        ];
    }

    public function getAnimesBySeason(int $year, string $season)
    {
        $season_navigation = $this->getSeasonNavigation($year, $season);

        $result = $this->requestJikan('season/' . $year . '/' . $season, ['jikan-season', 'jikan-season-' . $year], 'jikan-season-' . $year . '-' . $season);

        $animes = collect($result['anime']);

        return [
            'seasons' => $season_navigation,
            'animes' => $animes
        ];
    }
    
    public function getAnimesByGenre(int $id, int $page = 1)
    {
        $result = $this->requestJikan('genre/anime/' . $id . '/' . $page, ['jikan-anime-genre'], 'jikan-genre-' . $id . '-' . $page);

        return [
            'total' => $result['item_count'],
            'mal_details' => $result['mal_url'],
            'animes' => collect($result['anime'])
        ];
    }

    public function getAnime(string $id)
    {
        $result = $this->requestJikan('anime/' . $id, ['jikan-anime'], 'jikan-anime-' . $id);

        return $result;
    }

    public function getAnimeRecommendations(string $id)
    {
        $result = $this->requestJikan('anime/' . $id . '/recommendations', ['jikan-anime-recommendations'], 'jikan-anime-recommendations-' . $id, now()->addDays(3)->endOfDay());

        return collect($result['recommendations'])->take(6);
    }

    public function searchAnime(string $query)
    {
        $result = $this->requestJikan('search/anime', ['jikan-search'], 'jikan-search-anime-' .  $query, now()->addDays(5)->endOfDay(), [
            'q' => $query,
            'limit' => 6,
        ]);

        return $result['results'];
    }

    private function requestJikan(string $uri, array $cache_tags, string $cache_key = '', Carbon $cache_expire = null, array $query = null)
    {
        $uri = trim($uri, '/');
        
        $cache_tags = array_merge(['jikan'], $cache_tags);

        $cache = Cache::tags($cache_tags);

        if (empty($cache_key))
        {
            $cache_key = 'jikan-' . Str::replace('/', '-', $uri);
        }

        if (is_null($cache_expire))
        {
            $cache_expire = now()->endOfDay();
        }

        $jikan_data = $cache->get($cache_key);

        if (is_null($jikan_data))
        {
            $full_url = $this->base_uri . $uri;

            $this->logJikan($full_url, $query);

            $jikan_response = Http::withoutVerifying()->acceptJson()->get($this->base_uri . $uri, $query);

            if ($jikan_response->failed())
            {
                $status = $jikan_response->status();
                $exception_body = $jikan_response->collect();
                $exception_message = 'Type: ' . $exception_body['type'] . ' (' . $exception_body['message'] . ')';

                throw new JikanException($status, $exception_message);
            }

            $jikan_data = $jikan_response->body();

            $cache->put($cache_key, $jikan_data, $cache_expire);
        }

        return collect(json_decode($jikan_data, true));
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
            $previous_year_seasons = $all_seasons->get($year - 1);
            if (!is_null($previous_year_seasons))
            {
                $previous['season'] = Str::lower($previous_year_seasons->last());
                $previous['year'] = $year - 1;
            }
        }
        else
        {
            $previous['season'] = Str::lower($current_year_seasons[$current_season_index - 1]);
            $previous['year'] = $year;
        }

        $next = null;
        if ($current_season_index == $current_year_seasons->count() - 1)
        {
            $next_year_seasons = $all_seasons->get($year + 1);
            if (!is_null($next_year_seasons))
            {
                $next['season'] = Str::lower($next_year_seasons->first());
                $next['year'] = $year + 1;
            }
        }
        else
        {
            $next['season'] = Str::lower($current_year_seasons[$current_season_index + 1]);
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
        $all_seasons = $this->requestJikan('season/archive', ['jikan-season', 'jikan-season-archive'], 'jikan-season-archive', now()->addDays(14));
        return collect($all_seasons['archive'])->where('year', '>=', 1995)->mapWithKeys(function ($item, $key) {
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
        Log::channel('jikan')->info($log);
    }
}
