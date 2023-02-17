<?php

namespace App\Http\Controllers;

use App\Services\Contracts\GenreServiceInterface;
use App\Services\Contracts\JikanServiceInterface;
use App\Services\Contracts\ResourceServiceInterface;
use App\ViewModels\GenreViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GenreController extends Controller
{
    public function __construct(
        private GenreServiceInterface $genre_service,
        private JikanServiceInterface $jikan_service,
        private ResourceServiceInterface $resource_service
    )
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $all_genres = $this->genre_service->all();

        return response()->view('animes.genre-index', [
            'genres' => $all_genres->sortBy('name')
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug, Request $request): Response|RedirectResponse
    {
        $genre = $this->genre_service->getBySlug($slug);

        $page = $request->input('page', 1);

        if (!validate_page($page)) {
            return redirect()->to(url()->current());
        }

        $result = $this->jikan_service->getAnimesByGenre($genre->id, $page);

        $resources = $this->resource_service->getByMalIds($result['animes']->pluck('mal_id'));

        $genre_view_model = new GenreViewModel($genre, $page, $result['pagination'], $result['animes'], $resources);

        return response()->view('animes.genre', $genre_view_model);
    }
}
