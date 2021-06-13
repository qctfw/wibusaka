<?php

namespace App\Http\Controllers;

use App\Services\Contracts\JikanServiceInterface;
use App\ViewModels\AnimeViewModel;
use App\ViewModels\SeasonViewModel;
use App\ViewModels\TopIndexViewModel;
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
        $top = $this->jikan_service->getTopAnimes();
        $upcoming = $this->jikan_service->getTopUpcomingAnimes();

        $top_index_view_model = new TopIndexViewModel($top, $upcoming);

        return view('animes.top', $top_index_view_model);
    }

    /**
     * Display inputted season.
     *
     * @return \Illuminate\Http\Response
     */
    public function season()
    {
        $result = $this->jikan_service->getCurrentSeason();

        $season_view_model = new SeasonViewModel($result['season_year'], $result['season_name'], $result['animes']);

        return view('animes.season', $season_view_model);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
