<?php

namespace App\Services;

use App\Exceptions\JikanException;
use App\Services\Contracts\JikanServiceInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class JikanService implements JikanServiceInterface
{
    private $base_uri;

    private const JIKAN_DEFAULT_QUERY = [
        'sfw' => true,
        'order_by' => 'members',
        'sort' => 'desc'
    ];

    private const JIKAN_ANIME_EXPLICIT_GENRE_IDS = [9, 12, 49];

    public function __construct()
    {
        $this->base_uri = 'https://api.jikan.moe/v4/';
    }

    public function getTopAnimes(string $category, int $page = 1)
    {
        $query = [...self::JIKAN_DEFAULT_QUERY, 'page' => $page];

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

        $result = $this->requestJikan(
            uri: 'anime',
            cache_tags: ['jikan-top', 'jikan-top-' . $category],
            cache_key:'jikan-top-' . $category . '-' . $page,
            query: $query
        );

        $animes = $this->collectAnimes($result['data']);

        return $animes;
    }

    public function getCurrentSeason()
    {
        $animes = $this->requestJikanAllPages(
            uri: 'seasons/now', 
            cache_tags: ['jikan-season'],
            cache_key: 'jikan-season-current'
        );

        $season_navigation = $this->getSeasonNavigation($animes->first()['year'], $animes->first()['season']);

        return [
            'seasons' => $season_navigation,
            'animes' => $animes
        ];
    }

    public function getAnimesBySeason(int $year, string $season)
    {
        $season_navigation = $this->getSeasonNavigation($year, $season);

        $animes = $this->requestJikanAllPages(
            uri: 'seasons/' . $year . '/' . $season,
            cache_tags: ['jikan-season', 'jikan-season-' . $year],
            cache_key: 'jikan-season-' . $year . '-' . $season
        );

        return [
            'seasons' => $season_navigation,
            'animes' => $animes
        ];
    }

    public function getAnimesByGenre(int $id, int $page = 1)
    {
        $query = [...self::JIKAN_DEFAULT_QUERY, 'genres' => $id, 'page' => $page, 'limit' => 24];

        $result = $this->requestJikan(
            uri: 'anime',
            cache_tags: ['jikan-anime-genre'],
            cache_key: 'jikan-genre-' . $id . '-' . $page,
            query: $query
        );

        $animes = $this->collectAnimes($result['data']);

        return [
            'pagination' => $result['pagination'],
            'animes' => $animes
        ];
    }

    public function getAnimesBySchedule(string $day)
    {
        $cache_tags = ['jikan-anime-schedule'];
        $cache_key = 'jikan-anime-schedule-' . $day;

        $animes = Cache::tags($cache_tags)->get($cache_key);

        if (is_null($animes))
        {
            $cache_expire = now()->endOfDay();

            $animes = $this->requestJikanAllPages(
                uri: 'schedules',
                cache_tags: $cache_tags,
                cache_key: 'jikan-anime-schedule-all',
                cache_expire: $cache_expire
            );

            $animes = $animes->where('broadcast.day', Carbon::create($day)->dayName)->whereNotNull('season')->sortBy('broadcast.time')->values();

            Cache::tags($cache_tags)->put($cache_key, $animes, $cache_expire);
        }

        return $animes;
    }

    public function getAnime(string $id)
    {
        $result = $this->requestJikan(
            uri: 'anime/' . $id . '/full',
            cache_tags: ['jikan-anime'],
            cache_key: 'jikan-anime-' . $id
        );

        return $this->formatAnime($result['data']);
    }

    public function getAnimesByProducer(string $producer_id, int $page = 1)
    {
        $query = [...self::JIKAN_DEFAULT_QUERY, 'producers' => $producer_id, 'page' => $page, 'limit' => 24];

        $result = $this->requestJikan(
            uri: 'anime',
            cache_tags: ['jikan-anime-producers'],
            cache_key: 'jikan-anime-producers-' . $producer_id . '-' . $page,
            query: $query
        );

        $animes = $this->collectAnimes($result['data']);

        return [
            'pagination' => $result['pagination'],
            'animes' => $animes
        ];
    }

    public function getAnimeRecommendations(string $id)
    {
        $result = $this->requestJikan(
            uri: 'anime/' . $id . '/recommendations',
            cache_tags: ['jikan-anime-recommendations'],
            cache_key: 'jikan-anime-recommendations-' . $id,
            cache_expire: now()->addDays(3)->endOfDay()
        );

        return collect($result['data'])->take(9);
    }

    public function searchAnime(string $query)
    {
        $query = [...self::JIKAN_DEFAULT_QUERY, 'q' => $query, 'limit' => 6];
        $result = $this->requestJikan(
            uri: 'anime',
            cache_tags: ['jikan-search'],
            cache_key: 'jikan-search-anime-' .  $query['q'],
            cache_expire: now()->addDays(5)->endOfDay(),
            query: $query
        );

        $animes = $this->collectAnimes($result['data']);

        return $animes;
    }

    public function getProducer(string $id)
    {
        $result = $this->requestJikan(
            uri: 'producers/' . $id . '/full',
            cache_tags: ['jikan-producers'],
            cache_key: 'jikan-producers-' . $id,
            cache_expire: now()->endOfDay()
        );

        return collect($result['data']);
    }

    private function requestJikan(string $uri, array $cache_tags, string $cache_key = '', Carbon $cache_expire = null, array $query = null)
    {
        if (Cache::has('jikan-rate-limit'))
        {
            throw new JikanException(429, __('error.jikan_rate_limit'));
        }

        $uri = trim($uri, '/');
        
        $cache_tags = ['jikan', ...$cache_tags];

        $cache = Cache::tags($cache_tags);

        if (empty($cache_key))
        {
            $cache_key = 'jikan-' . str($uri)->replace('/', '-');
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

            if ($jikan_response->failed())
            {
                switch ($status) {
                    case 404:
                        throw new NotFoundHttpException();
                        break;
                    case 429:
                        Cache::put('jikan-rate-limit', true, 15);
                        throw new JikanException($status, __('error.jikan_rate_limit'));
                        break;
                    default:
                        $this->throwJikanException($jikan_response);
                        break;
                }
            }

            $jikan_data = $jikan_response->body();

            if (str_contains($jikan_data, 'Exception",')) {
                $this->throwJikanException($jikan_response);
            }

            $cache->put($cache_key, $jikan_data, $cache_expire);
        }

        return collect(json_decode($jikan_data, true));
    }

    private function requestJikanAllPages(string $uri, array $cache_tags, string $cache_key = '', Carbon $cache_expire = null)
    {
        $animes = Cache::tags($cache_tags)->get($cache_key);

        if (is_null($cache_expire))
        {
            $cache_expire = now()->endOfDay();
        }

        if (is_null($animes))
        {
            $page = 1;
            $animes = [];
            $has_next_page = true;

            while ($has_next_page) {
                $result = $this->requestJikan($uri, $cache_tags, $cache_key . '-page-' . $page, $cache_expire, [
                    'page' => $page,
                    'limit' => 100
                ]);

                $animes = array_merge($animes, $result['data']);

                $page++;
                $has_next_page = $result['pagination']['has_next_page'];
            }

            Cache::tags($cache_tags)->put($cache_key, $animes, $cache_expire);
        }

        return $this->collectAnimes($animes);
    }

    private function getSeasonNavigation(int $year, string $season)
    {
        if (!$this->validateSeason($year, $season))
        {
            throw new NotFoundHttpException();
        }

        $current = [
            'season' => str($season)->lower(),
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
                $previous['season'] = str($previous_year_seasons->last())->lower();
                $previous['year'] = $current['year'] - 1;
            }
        }
        else
        {
            $previous['season'] = str($current_year_seasons[$current_season_index - 1])->lower();
            $previous['year'] = $current['year'];
        }

        $next = null;
        if ($current_season_index == $current_year_seasons->count() - 1)
        {
            $next_year_seasons = $all_seasons->get($current['year'] + 1);
            if (!is_null($next_year_seasons))
            {
                $next['season'] = str($next_year_seasons->first())->lower();
                $next['year'] = $current['year'] + 1;
            }
        }
        else
        {
            $next['season'] = str($current_year_seasons[$current_season_index + 1])->lower();
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
        $all_seasons = $this->requestJikan(
            uri: 'seasons',
            cache_tags: ['jikan-season', 'jikan-season-archive'],
            cache_key: 'jikan-season-archive',
            cache_expire: now()->addDays(14)
        );

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

        return is_integer($seasons->search(str($season)->lower()));
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

    private function throwJikanException($jikan_response)
    {
        $exception_body = $jikan_response->collect();

        $exception_message = 'URL: ' . $jikan_response->effectiveUri()->getPath() . ' Type: ' . $exception_body['type'] . ' (' . $exception_body['status'] . ' | ' . $exception_body['message'] . ')';

        throw new JikanException($jikan_response->status(), $exception_message);
    }

    private function collectAnimes(?array $animes)
    {
        return collect($animes)->map(function ($item) {
            return $this->formatAnime($item);
        });
    }

    private function formatAnime(array $anime)
    {
        $anime['aired'] = [
            'from' => (!empty($anime['aired']['from'])) ? Carbon::parse($anime['aired']['from'])->shiftTimezone($anime['broadcast']['timezone'])->setTimeFrom($anime['broadcast']['time'])->setTimezone(config('app.timezone')) : null,
            'to' => (!empty($anime['aired']['to'])) ? Carbon::parse($anime['aired']['to'])->shiftTimezone($anime['broadcast']['timezone'])->setTimeFrom($anime['broadcast']['time'])->setTimezone(config('app.timezone')) : null
        ];

        $anime['broadcast'] = [
            'day' => $anime['aired']['from']?->dayName,
            'time' => $anime['aired']['from']?->format('H:i'),
            'timezone' => $anime['aired']['from']?->tzName,
            'string' => (!empty($anime['broadcast']['time']) && !empty($anime['broadcast']['timezone'])) ? __('anime.single.broadcast_string', [
                'day' => $anime['aired']['from']->dayName,
                'time' => $anime['aired']['from']->format('H:i') . ' ' . $anime['aired']['from']->format('T')
            ]) : ''
        ];

        $anime['explicit_genres'] = collect($anime['explicit_genres']);

        $anime['genres'] = collect($anime['genres'])->filter(function ($genre) use ($anime) {
            if (in_array($genre['mal_id'], self::JIKAN_ANIME_EXPLICIT_GENRE_IDS)) {
                $anime['explicit_genres']->push($genre)->values();
                return false;
            }
            return true;
        });

        if (isset($anime['relations']))
        {
            $anime['relations'] = collect($anime['relations']);
        }

        if (isset($anime['external']))
        {
            $anime['external'] = collect($anime['external']);
        }

        $anime = collect($anime)->merge([
            'status' => __('anime.single.status_enums.' . str($anime['status'])->replace(' ', '_')->lower()),
            'rating' => (!is_null($anime['rating'])) ? explode(' - ', $anime['rating'])[0] : 'None',
            'score' => ($anime['score'] > 0) ? number_format($anime['score'], 2, '.', '') : 'N/A',
            'duration' => ($anime['duration'] != 'Unknown') ? str($anime['duration'])->replace(['hr', 'min', 'per ep'], ['jam', 'menit', ''])->trim() : '',
            'rank' => number_format($anime['rank']),
            'popularity' => number_format($anime['popularity']),
            'premiered' => (!empty($anime['season']) && !empty($anime['year'])) ? str($anime['season'])->ucfirst() . ' ' . $anime['year'] : null,
            'producers' => collect($anime['producers']),
            'licensors' => collect($anime['licensors']),
            'studios' => collect($anime['studios']),
            'themes' => collect($anime['themes']),
            'demographics' => collect($anime['demographics']),
        ]);

        return $anime;
    }
}
