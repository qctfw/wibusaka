<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class GenreViewModel extends ViewModel
{
    public $genre;

    public $page;

    public $pagination;

    public $details;

    public $animes;

    public $resources;

    public function __construct($genre, $page, $pagination, $animes, $resources)
    {
        $this->genre = $genre;
        $this->page = $page;
        $this->pagination = $pagination;
        $this->animes = $animes;
        $this->resources = $resources;
    }

    public function animes()
    {
        return collect($this->animes)->where('members', '>', 1000)->where('r18', false)->where('continuing', false)->where('kids', false)->map(function ($item, $key) {

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
