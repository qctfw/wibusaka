<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class GenreViewModel extends ViewModel
{
    public $genre;

    public $page;

    public $total;

    public $details;

    public $animes;

    public $resources;

    public function __construct($genre, $page, $total, $details, $animes, $resources)
    {
        $this->genre = $genre;
        $this->page = $page;
        $this->total = $total;
        $this->details = $details;
        $this->animes = $animes;
        $this->resources = $resources;
    }

    public function total_page()
    {
        $total_page = intdiv($this->total, 100);
        
        if ($this->total % 100 > 0)
        {
            $total_page += 1;
        }

        return $total_page;
    }
    
    public function animes()
    {
        return collect($this->animes)->where('members', '>', 1000)->where('r18', false)->where('continuing', false)->where('kids', false)->map(function ($item, $key) {
            return collect($item)->merge([
                "airing_start" => (!is_null($item['airing_start'])) ? Carbon::parse($item['airing_start'])->translatedFormat('d F Y') : '?',
                "score" => ($item['score'] > 0) ? number_format($item['score'], 2, '.', '') : 'N/A'
            ]);
        });
    }
}
