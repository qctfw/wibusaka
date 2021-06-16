<?php

namespace App\Http\Controllers;

use App\Exceptions\HttpRequestException;
use App\Services\Contracts\JikanServiceInterface;
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

    public function __construct(JikanServiceInterface $jikan_service)
    {
        $this->jikan_service = $jikan_service;
    }

    /**
     * Display the main page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $top = $this->jikan_service->getTopPopularityAnimes();
        $upcoming = $this->jikan_service->getTopUpcomingAnimes();

        $top_index_view_model = new TopIndexViewModel($top, $upcoming);

        return view('index', $top_index_view_model);
    }

    /**
     * Display top rated anime.
     * 
     * @return \Illuminate\Http\Response
     */
    public function topRated($page = 1)
    {
        $top = $this->jikan_service->getTopRatedAnimes($page);

        $top_view_model = new TopViewModel('Terbaik', $top);

        return view('animes.top', $top_view_model);
    }

    /**
     * Display top rated anime.
     * 
     * @return \Illuminate\Http\Response
     */
    public function topPopular($page = 1)
    {
        $top = $this->jikan_service->getTopPopularityAnimes($page);

        $top_view_model = new TopViewModel('Terpopuler', $top);

        return view('animes.top', $top_view_model);
    }

    /**
     * Display top rated anime.
     * 
     * @return \Illuminate\Http\Response
     */
    public function topUpcoming($page = 1)
    {
        $top = $this->jikan_service->getTopUpcomingAnimes($page);

        $top_view_model = new TopViewModel('Paling Dinantikan', $top);

        return view('animes.top', $top_view_model);
    }

    /**
     * Display animes by season.
     *
     * @return \Illuminate\Http\Response
     */
    public function season($year = null, $season = null)
    {
        $date = !is_null($year) ? Carbon::parse($year) : now();
        
        if (!is_null($season))
            $this->validateSeason($season);
        else
            $season = $this->getSeason(now());

        $result = $this->jikan_service->getAnimesBySeason($date->year, $season);

        $season_view_model = new SeasonViewModel($result['season_year'], $result['season_name'], $result['animes']);

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
        $result = $this->jikan_service->getAnime($id);

        $anime_view_model = new AnimeViewModel($result);

        return view('animes.single', $anime_view_model);
    }

    private function validateSeason($season)
    {
        if (!in_array($season, ['winter', 'spring', 'summer', 'fall']))
            abort(404, 'Musim Tidak Diketahui');
    }

    private function getSeason(Carbon $date)
    {
        $season = '';
        switch($date->month)
        {
            case 1:
            case 2:
            case 3:
                $season = 'winter';
                break;
            case 4:
            case 5:
            case 6:
                $season = 'spring';
                break;
            case 7:
            case 8:
            case 9:
                $season = 'summer';
                break;
            case 10:
            case 11:
            case 12:
                $season = 'fall';
                break;
        }
        return $season;
    }

}
