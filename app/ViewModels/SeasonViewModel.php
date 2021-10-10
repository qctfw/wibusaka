<?php

namespace App\ViewModels;

use Carbon\Carbon;
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
        $animes = collect($this->animes)->sortByDesc('members');
        
        return $animes->map(function ($item, $key) {
            if(!is_null($item['airing_start']))
            {
                $item['airing_start'] = Carbon::parse($item['airing_start']);
                $item['airing_start'] = (count($item['demographics']) > 0) ? $item['airing_start']->translatedFormat('d M Y') : $item['airing_start']->translatedFormat('d F Y');
            }
            else {
                $item['airing_start'] = '?';
            }
            return collect($item)->merge([
                "airing_start" => $item['airing_start'],
                "score" => ($item['score'] > 0) ? number_format($item['score'], 2, '.', '') : 'N/A'
            ]);
        });
    }
}
