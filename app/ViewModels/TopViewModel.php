<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\ViewModels\ViewModel;

class TopViewModel extends ViewModel
{
    public $title;
    public $page;
    public $total_page;
    public $top_animes;
    public $resources;

    public function __construct($title, $page, $total_page, $top_animes, $resources)
    {
        $this->title = $title;
        $this->page = $page;
        $this->total_page = $total_page;
        $this->top_animes = $top_animes;
        $this->resources = $resources;
    }

    public function top_animes()
    {
        return $this->top_animes->map(function ($item, $key) {
            return collect($item)->merge([
                'aired' => [
                    'from' => (!is_null($item['aired']['from'])) ? $item['aired']['from']->translatedFormat('d M Y') : '?',
                    'to' => (!is_null($item['aired']['to'])) ? $item['aired']['to']->translatedFormat('d M Y') : '?'
                ],
                'members' => abbreviate_number($item['members'])
            ]);
        });
    }
}
