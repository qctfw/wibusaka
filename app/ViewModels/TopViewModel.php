<?php

namespace App\ViewModels;

use Illuminate\Support\Str;
use Spatie\ViewModels\ViewModel;

class TopViewModel extends ViewModel
{
    public $type;
    public $page;
    public $total_page;
    public $top_animes;
    public $resources;

    public function __construct($type, $page, $total_page, $top_animes, $resources)
    {
        $this->type = $type;
        $this->page = $page;
        $this->total_page = $total_page;
        $this->top_animes = $top_animes;
        $this->resources = $resources;
    }

    public function top_animes()
    {
        return $this->top_animes->map(function ($item, $key) {
            return collect($item)->merge([
                'members' => abbreviate_number($item['members']),
                'score' => ($item['score'] > 0) ? number_format($item['score'], 2, '.', '') : 'N/A'
            ]);
        });
    }
}
