<?php

namespace App\Http\Controllers;

use App\Services\Contracts\JikanServiceInterface;
use App\Services\Contracts\ResourceServiceInterface;
use App\ViewModels\TopViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TopAnimeController extends Controller
{
    public function __construct(
        private JikanServiceInterface $jikan_service,
        private ResourceServiceInterface $resource_service
    )
    {
    }

    public function rated(Request $request): Response|RedirectResponse
    {
        $total_page = 50;
        $page = $request->input('page', 1);

        if (!validate_page($page, $total_page)) {
            return redirect()->to(url()->current());
        }

        $response = $this->fetchRequest('rating', $page);

        $top_view_model = new TopViewModel(__('anime.top.title.rated'), $page, $total_page, $response['animes'], $response['resources']);

        return response()->view('animes.top', $top_view_model);
    }

    public function airing(Request $request): Response|RedirectResponse
    {
        $total_page = 1;
        $page = $request->input('page', 1);

        if (!validate_page($page, $total_page)) {
            return redirect()->to(url()->current());
        }

        $response = $this->fetchRequest('airing', $page);

        $top_view_model = new TopViewModel(__('anime.top.title.airing'), $page, $total_page, $response['animes'], $response['resources']);

        return response()->view('animes.top', $top_view_model);
    }

    public function popular(Request $request): Response|RedirectResponse
    {
        $total_page = 50;
        $page = $request->input('page', 1);

        if (!validate_page($page, $total_page)) {
            return redirect()->to(url()->current());
        }

        $response = $this->fetchRequest('popularity', $page);

        $top_view_model = new TopViewModel(__('anime.top.title.popularity'), $page, $total_page, $response['animes'], $response['resources']);

        return response()->view('animes.top', $top_view_model);
    }

    public function upcoming(Request $request): Response|RedirectResponse
    {
        $total_page = 3;
        $page = $request->input('page', 1);

        if (!validate_page($page, $total_page)) {
            return redirect()->to(url()->current());
        }

        $response = $this->fetchRequest('upcoming', $page);

        $top_view_model = new TopViewModel(__('anime.top.title.upcoming'), $page, $total_page, $response['animes'], $response['resources']);

        return response()->view('animes.top', $top_view_model);
    }

    private function fetchRequest($category, $page)
    {
        $animes = $this->jikan_service->getTopAnimes($category, $page);

        $anime_resources = $this->resource_service->getByMalIds($animes->pluck('mal_id'));

        return [
            'animes' => $animes,
            'resources' => $anime_resources
        ];
    }

}
