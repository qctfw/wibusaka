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
            $top = $this->jikan_service->getTopPopularityAnimes();
            $upcoming = $this->jikan_service->getTopUpcomingAnimes();
        } catch (JikanException $e)
        {
            abort($e->getHttpCode());
        }
        
        $top_resources = $this->resource_service->getByMalIds($top->pluck('mal_id'));

        $top_index_view_model = new TopIndexViewModel($top, $top_resources, $upcoming);

        return view('index', $top_index_view_model);
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
}
