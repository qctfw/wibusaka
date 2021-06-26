<?php

namespace App\Http\Controllers;

use App\Exceptions\JikanException;
use App\Services\Contracts\JikanServiceInterface;
use App\Services\Contracts\ResourceServiceInterface;
use App\ViewModels\AnimeViewModel;
use App\ViewModels\SeasonViewModel;
use App\ViewModels\TopIndexViewModel;
use App\ViewModels\TopViewModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
     * Display top rated anime.
     * 
     * @return \Illuminate\Http\Response
     */
    public function topRated(Request $request)
    {
        $total_page = 50;
        $page = $request->input('page', 1);

        $this->validatePage($page, $total_page);

        try
        {
            $top = $this->jikan_service->getTopRatedAnimes($page);
        } catch (JikanException $e)
        {
            abort($e->getHttpCode());
        }
        
        $top_resources = $this->resource_service->getByMalIds($top->pluck('mal_id'));

        $top_view_model = new TopViewModel('Terbaik', $page, $total_page, $top, $top_resources);

        return view('animes.top', $top_view_model);
    }

    /**
     * Display top rated anime.
     * 
     * @return \Illuminate\Http\Response
     */
    public function topPopular(Request $request)
    {
        $total_page = 50;
        $page = $request->input('page', 1);

        $this->validatePage($page, $total_page);

        try
        {
            $top = $this->jikan_service->getTopPopularityAnimes($page);
        } catch (JikanException $e)
        {
            abort($e->getHttpCode());
        }
        
        $top_resources = $this->resource_service->getByMalIds($top->pluck('mal_id'));

        $top_view_model = new TopViewModel('Terpopuler', $page, $total_page, $top, $top_resources);

        return view('animes.top', $top_view_model);
    }

    /**
     * Display top rated anime.
     * 
     * @return \Illuminate\Http\Response
     */
    public function topUpcoming(Request $request)
    {
        $total_page = 3;
        $page = $request->input('page', 1);

        $this->validatePage($page, $total_page);

        try
        {
            $top = $this->jikan_service->getTopUpcomingAnimes($page);
        } catch (JikanException $e)
        {
            abort($e->getHttpCode());
        }
        
        $top_resources = $this->resource_service->getByMalIds($top->pluck('mal_id'));

        $top_view_model = new TopViewModel('Paling Dinantikan', $page, $total_page, $top, $top_resources);

        return view('animes.top', $top_view_model);
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
            $date = !is_null($year) ? Carbon::parse($year) : now();
            
            if (!is_null($season))
            {
                $this->validateSeason($season);
                $result = $this->jikan_service->getAnimesBySeason($date->year, $season);
            }
            else
            {
                $result = $this->jikan_service->getCurrentSeason();
            }
        } catch (JikanException $e)
        {
            abort($e->getHttpCode());
        }
        $season_resources = $this->resource_service->getByMalIds($result['animes']->pluck('mal_id'));

        $season_view_model = new SeasonViewModel($result['season_year'], $result['season_name'], $result['animes'], $season_resources);

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

    private function validatePage($page, $total_page)
    {
        if (!preg_match('/^\d+$/', $page) || $page < 1 || $page > $total_page)
        {
            return redirect()->to(url()->current());
        }
    }

    private function validateSeason($season)
    {
        if (!in_array($season, ['winter', 'spring', 'summer', 'fall']))
            abort(404, 'Musim Tidak Diketahui');
    }
}
