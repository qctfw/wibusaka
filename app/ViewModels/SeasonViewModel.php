<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class SeasonViewModel extends ViewModel
{
    public function __construct(
        public $seasons,
        public $animes,
        public $resources
    )
    {}

    public function animes()
    {
        $animes = $this->animes;

        $animes = $animes->reject(function ($value) {
            if (str($value['rating'])->contains('Rx')) return true;
            foreach (array_merge($value['genres'], $value['explicit_genres']) as $genre) {
                if (str($genre['name'])->contains(['Erotica', 'Hentai']))
                    return true;
            }
        })->values();

        return $animes;
    }
}
