<?php

namespace App\Http\Controllers;

use App\Exceptions\JikanException;
use App\Services\Contracts\JikanServiceInterface;
use App\Services\Contracts\ResourceServiceInterface;
use App\ViewModels\AnimeViewModel;
use App\ViewModels\SeasonViewModel;
use App\ViewModels\TopIndexViewModel;

class AnimeController extends Controller
{
    /**
     * @var JikanServiceInterface
     */
    private $jikan_service;

    /**
     * @var ResourceServiceInterface
     */
    private $resource_service;

    public function __construct(JikanServiceInterface $jikan_service, ResourceServiceInterface $resource_service)
    {
        $this->jikan_service = $jikan_service;
        $this->resource_service = $resource_service;
    }

    /**
     * Display the main page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try
        {
            $current_season = $this->jikan_service->getCurrentSeason();
            $current_season['animes'] = $current_season['animes']->take(25)->sortByDesc('members');

            $airing_animes = collect($this->jikan_service->getTopAnimes('airing'))->take(25)->sortByDesc('score');
            $upcoming_animes = collect($this->jikan_service->getTopAnimes('upcoming'))->take(25)->sortByDesc('members');
        } catch (JikanException $e)
        {
            abort($e->getHttpCode());
        }

        $all_mal_ids = collect([
            $current_season['animes']->pluck('mal_id'),
            $airing_animes->pluck('mal_id')
        ])->flatten()->unique()->sort()->values();

        $resources = $this->resource_service->getByMalIds($all_mal_ids);

        $current_season_title = 'Anime ' . $current_season['seasons']['current']['season'] . ' ' . $current_season['seasons']['current']['year'];
        $current_season = $this->buildIndexSection($current_season_title, 'anime.season-current', $current_season['animes']);

        $airing_animes = $this->buildIndexSection(__('anime.top.title.airing'), 'anime.top.airing', $airing_animes);

        $upcoming_animes = $this->buildIndexSection(__('anime.top.title.upcoming'), 'anime.top.upcoming', $upcoming_animes);

        $sections = collect([$current_season, $airing_animes, $upcoming_animes]);

        $top_index_view_model = new TopIndexViewModel($sections, $resources);

        return view('animes.index', $top_index_view_model);
    }

    /**
     * Display animes by season.
     *
     * @return \Illuminate\Http\Response
     */
    public function season($year = null, $season = null)
    {
        try
        {
            if (!is_null($season))
            {
                $result = $this->jikan_service->getAnimesBySeason($year, $season);
            }
            else
            {
                $result = $this->jikan_service->getCurrentSeason();
            }
        } catch (JikanException $e)
        {
            abort($e->getHttpCode());
        }

        $animes = $result['animes']->where('members', '>', 1000)->where('r18', false)->where('kids', false);

        $season_resources = $this->resource_service->getByMalIds($animes->pluck('mal_id'));

        $season_view_model = new SeasonViewModel($result['seasons'], $animes, $season_resources);

        return view('animes.season', $season_view_model);
    }

    /**
     * Display the specified anime.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try
        {
            $result = $this->jikan_service->getAnime(intval($id));
        } catch (JikanException $e)
        {
            abort($e->getHttpCode());
        }

        $anime_view_model = new AnimeViewModel($result);

        return view('animes.single', $anime_view_model);
    }

    private function buildIndexSection($title, $route, $animes)
    {
        return collect([
            'title' => $title,
            'route' => route($route),
            'animes' => $animes
        ]);
    }
}
