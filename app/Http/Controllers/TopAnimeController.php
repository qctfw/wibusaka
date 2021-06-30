<?php

namespace App\Http\Controllers;

use App\Exceptions\JikanException;
use App\Services\Contracts\JikanServiceInterface;
use App\Services\Contracts\ResourceServiceInterface;
use App\ViewModels\TopViewModel;
use Illuminate\Http\Request;

class TopAnimeController extends Controller
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

    public function rated(Request $request)
    {
        $total_page = 50;
        $page = $request->input('page', 1);

        if (!validate_page($page, $total_page)) {
            return redirect()->to(url()->current());
        }

        try
        {
            $top = $this->jikan_service->getTopRatedAnimes($page);
        } catch (JikanException $e)
        {
            abort($e->getHttpCode());
        }
        
        $top_resources = $this->resource_service->getByMalIds($top->pluck('mal_id'));

        $top_view_model = new TopViewModel('Anime Terbaik', $page, $total_page, $top, $top_resources);

        return view('animes.top', $top_view_model);
    }

    public function airing(Request $request)
    {
        $total_page = 1;
        $page = $request->input('page', 1);

        if (!validate_page($page, $total_page)) {
            return redirect()->to(url()->current());
        }

        try
        {
            $top = $this->jikan_service->getTopAiringAnimes($page);
        } catch (JikanException $e)
        {
            abort($e->getHttpCode());
        }
        
        $top_resources = $this->resource_service->getByMalIds($top->pluck('mal_id'));

        $top_view_model = new TopViewModel('Anime yang Sedang Tayang', $page, $total_page, $top, $top_resources);

        return view('animes.top', $top_view_model);
    }

    public function popular(Request $request)
    {
        $total_page = 50;
        $page = $request->input('page', 1);

        if (!validate_page($page, $total_page)) {
            return redirect()->to(url()->current());
        }

        try
        {
            $top = $this->jikan_service->getTopPopularityAnimes($page);
        } catch (JikanException $e)
        {
            abort($e->getHttpCode());
        }
        
        $top_resources = $this->resource_service->getByMalIds($top->pluck('mal_id'));

        $top_view_model = new TopViewModel('Anime Terpopuler', $page, $total_page, $top, $top_resources);

        return view('animes.top', $top_view_model);
    }

    public function upcoming(Request $request)
    {
        $total_page = 3;
        $page = $request->input('page', 1);

        if (!validate_page($page, $total_page)) {
            return redirect()->to(url()->current());
        }

        try
        {
            $top = $this->jikan_service->getTopUpcomingAnimes($page);
        } catch (JikanException $e)
        {
            abort($e->getHttpCode());
        }
        
        $top_resources = $this->resource_service->getByMalIds($top->pluck('mal_id'));

        $top_view_model = new TopViewModel('Anime Paling Dinantikan', $page, $total_page, $top, $top_resources);

        return view('animes.top', $top_view_model);
    }

}
