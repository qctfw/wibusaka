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
        $animes = collect($this->animes)->sortByDesc('members');
        
        $animes = $animes->reject(function ($value) {
            $is_nsfw = Str::contains($value['rating'], 'Rx');
            foreach (array_merge($value['genres'], $value['explicit_genres']) as $genre) {
                $is_nsfw = Str::contains($genre['name'], ['Erotica', 'Hentai']);
            }

            return $is_nsfw;
        });

        return $animes->map(function ($item, $key) {
            if(!is_null($item['aired']['from']))
            {
                $item['aired_at'] = Carbon::parse($item['aired']['from']);
                $item['aired_at'] = (count($item['demographics']) > 0) ? $item['aired_at']->translatedFormat('d M Y') : $item['aired_at']->translatedFormat('d F Y');
            }
            else {
                $item['aired_at'] = '?';
            }

            return collect($item)->merge([
                "aired_at" => $item['aired_at'],
                "score" => ($item['score'] > 0) ? number_format($item['score'], 2, '.', '') : 'N/A'
            ]);
        });
    }
}
