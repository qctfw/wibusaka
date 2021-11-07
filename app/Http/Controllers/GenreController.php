<?php

namespace App\Http\Controllers;

use App\Services\Contracts\GenreServiceInterface;
use App\Services\Contracts\JikanServiceInterface;
use App\Services\Contracts\ResourceServiceInterface;
use App\ViewModels\GenreViewModel;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * @var GenreServiceInterface
     */
    private $genre_service;

    /**
     * @var JikanServiceInterface
     */
    private $jikan_service;

    /**
     * @var ResourceServiceInterface
     */
    private $resource_service;

    /**
     * GenreController constructor.
     * 
     * @param GenreServiceInterface
     * @param JikanServiceInterface
     * @param ResourceServiceInterface
     */
    public function __construct(GenreServiceInterface $genre_service, JikanServiceInterface $jikan_service, ResourceServiceInterface $resource_service)
    {
        $this->genre_service = $genre_service;
        $this->jikan_service = $jikan_service;
        $this->resource_service = $resource_service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_genres = $this->genre_service->all();

        return view('animes.genre-index', [
            'genres' => $all_genres->sortBy('name')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show($slug, Request $request)
    {
        $genre = $this->genre_service->getBySlug($slug);

        $page = $request->input('page', 1);

        if (!validate_page($page)) {
            return redirect()->to(url()->current());
        }

        $result = $this->jikan_service->getAnimesByGenre($genre->id, $page);

        $resources = $this->resource_service->getByMalIds($result['animes']->pluck('mal_id'));
        
        $genre_view_model = new GenreViewModel($genre, $page, $result['total'], $result['mal_details'], $result['animes'], $resources);

        return view('animes.genre', $genre_view_model);
    }
}
