<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;
use Illuminate\Support\Str;

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
            $is_nsfw = Str::contains($value['rating'], 'Rx');
            foreach (array_merge($value['genres']->toArray(), $value['explicit_genres']->toArray()) as $genre) {
                $is_nsfw = Str::contains($genre['name'], ['Erotica', 'Hentai']);
            }

            return $is_nsfw;
        });

        return $animes;
    }
}
