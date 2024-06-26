<?php

namespace App\Services;

use App\Datas\AnimeData;
use App\Exceptions\JikanException;
use App\Services\Contracts\JikanServiceInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class JikanService implements JikanServiceInterface
{
    private string $base_uri;

    private const JIKAN_DEFAULT_QUERY = [
        'sfw' => true,
        'order_by' => 'members',
        'sort' => 'desc'
    ];

    public function __construct()
    {
        $this->base_uri = config('anime.jikan.base_url', 'https://api.jikan.moe/v4/');
    }

    public function getTopAnimes(string $category, int $page = 1)
    {
        $cache = Cache::tags(['jikan', 'jikan-top', 'jikan-top-' . $category]);
        $cache_key = 'jikan-top-' . $category . '-' . $page;

        $animes = $cache->get($cache_key);

        if (is_null($animes)) {
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

            $result = $this->requestJikan('anime', $query);

            $animes = $this->collectAnimes($result['data']);

            $cache->put($cache_key, $animes, now()->endOfDay());
        }

        return $animes;
    }

    public function getCurrentSeason()
    {
        $now = now();

        $season = season($now);

        return $this->getAnimesBySeason($now->year, $season);
    }

    public function getAnimesBySeason(int $year, string $season)
    {
        $season_navigation = $this->getSeasonNavigation($year, $season);

        $cache = Cache::tags(['jikan', 'jikan-season', 'jikan-season-' . $year]);
        $cache_key = 'jikan-season-' . $year . '-' . $season;

        $animes = $cache->get($cache_key);

        if (is_null($animes)) {
            $animes = $this->requestJikanAllPages('seasons/' . $year . '/' . $season);

            // Temp fix for unknown year anime appeared in Winter season
            if ($year >= now()->year && $season == 'winter') {
                $animes = $animes->filter(function ($anime) {
                    return $anime->aired_from_properties->has_year === true
                    && $anime->aired_from_properties->has_month === true
                    && $anime->aired_from_properties->has_day === true;
                });
            }

            $cache->put($cache_key, $animes, now()->endOfDay());
        }

        return [
            'seasons' => $season_navigation,
            'animes' => $animes
        ];
    }

    public function getAnimesByGenre(int $id, int $page = 1)
    {
        $cache = Cache::tags(['jikan', 'jikan-anime-genre']);
        $cache_key = 'jikan-genre-' . $id . '-' . $page;
        $cache_key_pagination = 'jikan-genre-' . $id . '-' . $page . '-pagination';

        $animes = $cache->get($cache_key);
        $pagination = $cache->get($cache_key_pagination);

        if (is_null($animes)) {
            $query = [...self::JIKAN_DEFAULT_QUERY, 'genres' => $id, 'page' => $page, 'limit' => 24];

            $result = $this->requestJikan('anime', $query);

            $animes = $this->collectAnimes($result['data']);
            $pagination = $result['pagination'];

            $cache->put($cache_key, $animes, now()->endOfDay());
            $cache->put($cache_key_pagination, $pagination, now()->endOfDay());
        }

        return [
            'pagination' => $pagination,
            'animes' => $animes
        ];
    }

    public function getAnimesBySchedule(string $day)
    {
        $cache = Cache::tags(['jikan', 'jikan-anime-schedule']);
        $cache_expire = now()->endOfDay();
        $cache_key_current_day = 'jikan-anime-schedule-' . $day;

        $animes = $cache->get($cache_key_current_day);

        if (is_null($animes))
        {
            $cache_key_all_days = 'jikan-anime-schedule-all';

            $all_animes = $cache->get($cache_key_all_days);

            if (is_null($all_animes)) {
                $all_animes = $this->requestJikanAllPages('schedules');

                $cache->put($cache_key_all_days, $all_animes, $cache_expire);
            }

            $animes = $all_animes
                ->where('year', '>=', now()->subYear()->year)
                ->where('members', '>=', config('anime.season.min_members'))
                ->where('broadcast.day', Carbon::create($day)->dayName)
                ->whereNotNull('season')
                ->sortBy('broadcast.time')
                ->values();

            $cache->put($cache_key_current_day, $animes, $cache_expire);
        }

        return $animes;
    }

    public function getUpcomingBroadcastAnimes(Carbon $time = null)
    {
        $time = $time ?: now()->startOfMinute();

        $cache = Cache::tags(['jikan', 'jikan-anime-schedule']);
        $cache_key = 'jikan-anime-schedule-all';

        $animes = $cache->get($cache_key);

        if (is_null($animes)) {
            $animes = $this->requestJikanAllPages('schedules');

            $cache->put($cache_key, $animes, now()->endOfDay());
        }

        $animes = $animes
            ->where('year', '>=', now()->subYear()->year)
            ->where('members', '>=', config('anime.season.min_members'))
            ->whereNotNull('season')
            ->sortBy('broadcast.time');

        $result = $animes->filter(function ($value, $key) use ($time) {
            if (is_null($value['broadcast'])) return false;
            $anime_max_time = Carbon::parse($value['broadcast']['time'])->addMinutes($value['duration']?->minute);

            return $time->dayName == $value['broadcast']['day'] && $time->lessThanOrEqualTo($anime_max_time);
        });

        $max = config('anime.index.max_schedule', 6);

        if ($result->count() < $max) {
            $time->addDay();
            $result->push(...$animes->where('broadcast.day', $time->dayName));
        }

        return $result->take($max)->values();
    }

    public function getAnime(string $id)
    {
        $cache = Cache::tags(['jikan', 'jikan-anime']);
        $cache_key = 'jikan-anime-' . $id;

        $anime = $cache->get($cache_key);

        if (is_null($anime)) {
            $result = $this->requestJikan('anime/' . $id . '/full');

            $anime = AnimeData::fromJikan($result['data']);

            $cache->put($cache_key, $anime, now()->endOfDay());
        }

        return $anime;
    }

    public function getAnimesByProducer(string $producer_id, int $page = 1)
    {
        $cache = Cache::tags(['jikan', 'jikan-anime-producers']);
        $cache_key = sprintf('jikan-anime-producers-%s-%d', $producer_id, $page);
        $cache_key_pagination = sprintf('jikan-anime-producers-%s-%d-pagination', $producer_id, $page);

        $animes = $cache->get($cache_key);
        $pagination = $cache->get($cache_key_pagination);

        if (is_null($animes)) {
            $query = [...self::JIKAN_DEFAULT_QUERY, 'producers' => $producer_id, 'page' => $page, 'limit' => 24];

            $result = $this->requestJikan('anime', $query);

            $animes = $this->collectAnimes($result['data']);
            $pagination = $result['pagination'];

            $cache->put($cache_key, $animes, now()->endOfDay());
            $cache->put($cache_key_pagination, $pagination, now()->endOfDay());
        }

        return [
            'pagination' => $pagination,
            'animes' => $animes
        ];
    }

    public function getAnimeRecommendations(string $id)
    {
        $cache = Cache::tags(['jikan', 'jikan-anime-recommendations']);
        $cache_key = 'jikan-anime-recommendations-' . $id;

        $animes = $cache->get($cache_key);

        if (is_null($animes)) {
            $result = $this->requestJikan('anime/' . $id . '/recommendations');

            $animes = collect($result['data'])->take(9);

            $cache->put($cache_key, $animes, now()->addDays(3)->endOfDay());
        }

        return $animes;
    }

    public function searchAnime(string $query)
    {
        $cache = Cache::tags(['jikan', 'jikan-search']);
        $cache_key = 'jikan-search-anime-' .  $query;

        $animes = $cache->get($cache_key);

        if (is_null($animes)) {
            $query = [...self::JIKAN_DEFAULT_QUERY, 'q' => $query, 'limit' => 6];
            $result = $this->requestJikan('anime', $query);

            $animes = $this->collectAnimes($result['data']);

            $cache->put($cache_key, $animes, now()->addDays(5)->endOfDay());
        }

        return $animes;
    }

    public function getProducer(string $id)
    {
        $cache = Cache::tags(['jikan', 'jikan-producers']);
        $cache_key = 'jikan-producers-' . $id;

        $producer = $cache->get($cache_key);

        if (is_null($producer)) {
            $result = $this->requestJikan('producers/' . $id . '/full');

            $producer = collect($result['data']);

            $cache->put($cache_key, $producer, now()->endOfDay());
        }

        return $producer;
    }

    private function requestJikan(string $uri, array $query = [])
    {
        if (Cache::has('jikan-rate-limit'))
        {
            throw new JikanException(429, __('error.jikan_rate_limit'));
        }

        $uri = trim($uri, '/');

        $jikan_response = Http::withoutVerifying()
            ->baseUrl($this->base_uri)
            ->withHeaders(['Accept-Encoding' => 'gzip, deflate, br'])
            ->acceptJson()
            ->get($uri, $query);

        $status = $jikan_response->status();

        $this->logJikan($this->base_uri . $uri, $query, $status);

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

        return $jikan_response->collect();
    }

    private function requestJikanAllPages(string $uri, array $query = [])
    {
        $page = 1;
        $animes = [];
        $has_next_page = true;

        while ($has_next_page) {
            $result = $this->requestJikan($uri, ['page' => $page, 'limit' => 25, ...$query]);

            $animes = array_merge($animes, $result['data']);

            $page++;
            $has_next_page = $result['pagination']['has_next_page'];
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
        $cache = Cache::tags(['jikan', 'jikan-season', 'jikan-season-archive']);
        $cache_key = 'jikan-season-archive';

        $all_seasons = $cache->get($cache_key);

        if (is_null($all_seasons)) {
            $result = $this->requestJikan('seasons');

            $all_seasons = collect($result['data'])->where('year', '>=', 1995)->mapWithKeys(function ($item, $key) {
                return [ $item['year'] => collect($item['seasons']) ];
            });

            $cache->put($cache_key, $all_seasons, now()->addWeeks(2)->endOfDay());
        }

        return $all_seasons;
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

    private function logJikan(string $full_url, ?array $query, int $status)
    {
        $query = $query ?: [];

        $log = sprintf('Requesting Jikan... URL: %s Query: %s Status: %d', $full_url, http_build_query($query), $status);

        Log::channel('jikan')->info($log);
    }

    private function throwJikanException($jikan_response)
    {
        $exception_body = $jikan_response->collect();

        $exception_message = sprintf(
            'URL: %s Type: %s (%s | %s)',
            $jikan_response->effectiveUri()->getPath(),
            $exception_body['type'],
            $exception_body['status'],
            $exception_body['message'] ?? ''
        );

        throw new JikanException($jikan_response->status(), $exception_message);
    }

    private function collectAnimes(?array $animes)
    {
        return collect($animes)->map(function ($item) {
            return AnimeData::fromJikan($item);
        });
    }
}
