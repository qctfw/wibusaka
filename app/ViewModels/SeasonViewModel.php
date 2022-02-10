<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class SeasonViewModel extends ViewModel
{
    public $seasons;

    public $animes;

    public $resources;

    public function __construct($seasons, $animes, $resources)
    {
        $this->seasons = $seasons;
        $this->animes = $animes;
        $this->resources = $resources;
    }

    public function animes()
    {
        $animes = $this->animes;
        
        $animes = $animes->reject(function ($value) {
            $is_nsfw = str($value['rating'])->contains('Rx');
            foreach (array_merge($value['genres']->toArray(), $value['explicit_genres']->toArray()) as $genre) {
                $is_nsfw = str($genre['name'])->contains(['Erotica', 'Hentai']);
            }

            return $is_nsfw;
        })->map(function ($anime) {
            $anime['type'] = null;

            return $anime;
        })->values();

        return $animes;
    }
}
