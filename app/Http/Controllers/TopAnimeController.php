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

        $response = $this->fetchRequest('', $page);

        $top_view_model = new TopViewModel(__('anime.top.title.rated'), $page, $total_page, $response['animes'], $response['resources']);

        return view('animes.top', $top_view_model);
    }

    public function airing(Request $request)
    {
        $total_page = 1;
        $page = $request->input('page', 1);

        if (!validate_page($page, $total_page)) {
            return redirect()->to(url()->current());
        }

        $response = $this->fetchRequest('airing', $page);

        $top_view_model = new TopViewModel(__('anime.top.title.airing'), $page, $total_page, $response['animes'], $response['resources']);

        return view('animes.top', $top_view_model);
    }

    public function popular(Request $request)
    {
        $total_page = 50;
        $page = $request->input('page', 1);

        if (!validate_page($page, $total_page)) {
            return redirect()->to(url()->current());
        }

        $response = $this->fetchRequest('bypopularity', $page);

        $top_view_model = new TopViewModel(__('anime.top.title.popularity'), $page, $total_page, $response['animes'], $response['resources']);

        return view('animes.top', $top_view_model);
    }

    public function upcoming(Request $request)
    {
        $total_page = 3;
        $page = $request->input('page', 1);

        if (!validate_page($page, $total_page)) {
            return redirect()->to(url()->current());
        }

        $response = $this->fetchRequest('upcoming', $page);

        $top_view_model = new TopViewModel(__('anime.top.title.upcoming'), $page, $total_page, $response['animes'], $response['resources']);

        return view('animes.top', $top_view_model);
    }

    private function fetchRequest($category, $page)
    {
        try
        {
            $animes = $this->jikan_service->getTopAnimes($category, $page);
        } catch (JikanException $e)
        {
            abort($e->getHttpCode());
        }

        $anime_resources = $this->resource_service->getByMalIds($animes->pluck('mal_id'));

        return [
            'animes' => $animes,
            'resources' => $anime_resources
        ];
    }

}
