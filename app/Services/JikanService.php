<?php

namespace App\Services;

use App\Exceptions\JikanException;
use App\Services\Contracts\JikanServiceInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class JikanService implements JikanServiceInterface
{
    private $base_uri;

    private const DEFAULT_JIKAN_QUERY = [
        'sfw' => true,
        'order_by' => 'members',
        'sort' => 'desc'
    ];

    public function __construct()
    {
        $this->base_uri = 'https://api.jikan.moe/v4/';
    }

    public function getTopAnimes(string $category = '', int $page = 1)
    {
        $query = array_merge(self::DEFAULT_JIKAN_QUERY, ['page' => $page]);

        switch ($category) {
            case 'rating':
                $query['order_by'] = 'score';
                break;
            case 'popularity':
                $query['order_by'] = 'members';
                break;
            case 'airing':
                $query['order_by'] = 'score';
                $query['status'] = 'airing';
                break;
            case 'upcoming':
                $query['order_by'] = 'members';
                $query['status'] = 'upcoming';
                break;
        }

        $result = $this->requestJikan('anime', ['jikan-top', 'jikan-top-' . $category], 'jikan-top-' . $category . '-' . $page, null, $query);

        $animes = collect($result['data'])->map(function ($item) {
            return $this->formatAnime($item);
        });

        return $animes;
    }

    public function getCurrentSeason()
    {
        $cache_tags = ['jikan-season'];
        $cache_key = 'jikan-season-current';
        $animes = Cache::tags($cache_tags)->get($cache_key);
        if (is_null($animes))
        {
            $page = 1;
            $animes = [];
            $has_next_page = true;

            while ($has_next_page) {
                $result = $this->requestJikan('seasons/now', $cache_tags, $cache_key . '-page-' . $page, now()->endOfDay(), [
                    'page' => $page
                ]);

                $animes = array_merge($animes, $result['data']);

                $page++;
                $has_next_page = $result['pagination']['has_next_page'];
            }

            Cache::tags($cache_tags)->put($cache_key, $animes, now()->endOfDay());
        }

        $animes = collect($animes)->map(function ($item) {
            return $this->formatAnime($item);
        });

        $season_navigation = $this->getSeasonNavigation($animes->first()['year'], $animes->first()['season']);

        return [
            'seasons' => $season_navigation,
            'animes' => $animes
        ];
    }

    public function getAnimesBySeason(int $year, string $season)
    {
        $season_navigation = $this->getSeasonNavigation($year, $season);

        $cache_tags = ['jikan-season', 'jikan-season-' . $year];
        $cache_key = 'jikan-season-' . $year . '-' . $season;

        $animes = Cache::tags($cache_tags)->get($cache_key);
        if (is_null($animes))
        {
            $page = 1;
            $animes = [];
            $has_next_page = true;

            while ($has_next_page) {
                $result = $this->requestJikan('seasons/' . $year . '/' . $season, $cache_tags, $cache_key . '-page-' . $page, now()->endOfDay(), [
                    'page' => $page
                ]);

                $animes = array_merge($animes, $result['data']);

                $page++;
                $has_next_page = $result['pagination']['has_next_page'];
            }

            Cache::tags($cache_tags)->put($cache_key, $animes, now()->endOfDay());
        }

        $animes = collect($animes)->map(function ($item) {
            return $this->formatAnime($item);
        });

        return [
            'seasons' => $season_navigation,
            'animes' => $animes
        ];
    }
    
    public function getAnimesByGenre(int $id, int $page = 1)
    {
        $query = array_merge(self::DEFAULT_JIKAN_QUERY, ['genres' => $id, 'page' => $page]);

        $result = $this->requestJikan('anime', ['jikan-anime-genre'], 'jikan-genre-' . $id . '-' . $page, null, $query);

        $animes = collect($result['data'])->map(function ($item) {
            return $this->formatAnime($item);
        });

        return [
            'pagination' => $result['pagination'],
            'animes' => $animes
        ];
    }

    public function getAnime(string $id)
    {
        $result = $this->requestJikan('anime/' . $id, ['jikan-anime'], 'jikan-anime-' . $id);

        $themes = $this->requestJikan('anime/' . $id . '/themes', ['jikan-anime-themes'], 'jikan-anime-themes-' . $id);

        $anime = array_merge($result['data'], $themes['data']);

        return $this->formatAnime($anime);
    }

    public function getAnimeRecommendations(string $id)
    {
        $result = $this->requestJikan('anime/' . $id . '/recommendations', ['jikan-anime-recommendations'], 'jikan-anime-recommendations-' . $id, now()->addDays(3)->endOfDay());

        return collect($result['data'])->take(9);
    }

    public function searchAnime(string $query)
    {
        $query = array_merge(self::DEFAULT_JIKAN_QUERY, ['q' => $query, 'limit' => 6]);
        $result = $this->requestJikan('anime', ['jikan-search'], 'jikan-search-anime-' .  $query['q'], now()->addDays(5)->endOfDay(), $query);

        $animes = collect($result['data'])->map(function ($item) {
            return $this->formatAnime($item);
        });

        return $animes;
    }

    private function requestJikan(string $uri, array $cache_tags, string $cache_key = '', Carbon $cache_expire = null, array $query = null)
    {
        if (Cache::has('jikan-rate-limit'))
        {
            throw new JikanException(429, __('error.jikan_rate_limit'));
        }

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

            $status = $jikan_response->status();

            if ($jikan_response->serverError())
            {
                $exception_body = $jikan_response->collect();
                $exception_message = 'Type: ' . $exception_body['type'] . ' (' . $exception_body['message'] . ')';

                throw new JikanException($status, $exception_message);
            }
            elseif ($jikan_response->clientError())
            {
                switch ($status) {
                    case 404:
                        throw new NotFoundHttpException();
                        break;
                    case 429:
                        Cache::put('jikan-rate-limit', true, 15);
                        throw new JikanException($status, __('error.jikan_rate_limit'));
                        break;
                }
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
            throw new NotFoundHttpException();
        }

        $current = [
            'season' => Str::lower($season),
            'year' => $year
        ];

        $all_seasons = $this->getAllowedSeasons();
        $current_year_seasons = $all_seasons->get($current['year']);

        $current_season_index = $current_year_seasons->search($current['season']);

        $previous = null;
        if ($current_season_index == 0)
        {
            $previous_year_seasons = $all_seasons->get($current['year'] - 1);
            if (!is_null($previous_year_seasons))
            {
                $previous['season'] = Str::lower($previous_year_seasons->last());
                $previous['year'] = $current['year'] - 1;
            }
        }
        else
        {
            $previous['season'] = Str::lower($current_year_seasons[$current_season_index - 1]);
            $previous['year'] = $current['year'];
        }

        $next = null;
        if ($current_season_index == $current_year_seasons->count() - 1)
        {
            $next_year_seasons = $all_seasons->get($current['year'] + 1);
            if (!is_null($next_year_seasons))
            {
                $next['season'] = Str::lower($next_year_seasons->first());
                $next['year'] = $current['year'] + 1;
            }
        }
        else
        {
            $next['season'] = Str::lower($current_year_seasons[$current_season_index + 1]);
            $next['year'] = $current['year'];
        }

        return [
            'previous' => $previous,
            'current' => $current,
            'next' => $next
        ];
    }

    private function getAllowedSeasons()
    {
        $all_seasons = $this->requestJikan('seasons', ['jikan-season', 'jikan-season-archive'], 'jikan-season-archive', now()->addDays(14));
        return collect($all_seasons['data'])->where('year', '>=', 1995)->mapWithKeys(function ($item, $key) {
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

        return is_integer($seasons->search(Str::lower($season)));
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

    private function formatAnime(array $anime)
    {
        $anime['aired'] = [
            'from' => (!empty($anime['aired']['from'])) ? Carbon::parse($anime['aired']['from'])->shiftTimezone($anime['broadcast']['timezone'])->setTimeFrom($anime['broadcast']['time'])->setTimezone(config('app.timezone')) : null,
            'to' => (!empty($anime['aired']['to'])) ? Carbon::parse($anime['aired']['to'])->shiftTimezone($anime['broadcast']['timezone'])->setTimeFrom($anime['broadcast']['time'])->setTimezone(config('app.timezone')) : null
        ];

        $anime['broadcast'] = [
            'day' => $anime['aired']['from']->dayName ?? null,
            'time' => (!empty($anime['aired']['from'])) ? $anime['aired']['from']->format('H:i') : null,
            'timezone' => $anime['aired']['from']->tzName ?? null,
            'string' => (!empty($anime['broadcast']['time']) && !empty($anime['broadcast']['timezone'])) ? __('anime.single.broadcast_string', [
                'day' => $anime['aired']['from']->dayName,
                'time' => $anime['aired']['from']->format('H:i') . ' ' . $anime['aired']['from']->format('T')
            ]) : ''
        ];

        $anime = collect($anime)->merge([
            'status' => __('anime.single.status_enums.' . Str::lower(Str::replace(' ', '_', $anime['status']))),
            'rating' => explode(' - ', $anime['rating'])[0],
            'score' => ($anime['score'] > 0) ? number_format($anime['score'], 2, '.', '') : 'N/A',
            'duration' => ($anime['duration'] != 'Unknown') ? trim(Str::replace(['hr', 'min', 'per ep'], ['jam', 'menit', ''], $anime['duration'])) : '',
            'rank' => number_format($anime['rank']),
            'popularity' => number_format($anime['popularity']),
            'premiered' => (!empty($anime['season']) && !empty($anime['year'])) ? Str::ucfirst($anime['season']) . ' ' . $anime['year'] : null,
            'studios' => collect($anime['studios']),
            'genres' => collect($anime['genres']),
            'explicit_genres' => collect($anime['explicit_genres']),
            'external_links' => [], // Not available in v4 right now
        ]);

        return $anime;
    }
}
