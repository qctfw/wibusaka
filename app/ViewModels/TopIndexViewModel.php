<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\ViewModels\ViewModel;

class TopIndexViewModel extends ViewModel
{
    public $top_animes;

    public $top_resources;

    public $upcoming_animes;

    public function __construct($top_animes, $top_resources, $upcoming_animes)
    {
        $this->top_animes = $top_animes;
        $this->top_resources = $top_resources;
        $this->upcoming_animes = $upcoming_animes;
    }

    public function top_animes()
    {
        return collect($this->top_animes)->take(12)->map(function ($item, $key) {
            return collect($item)->merge([
                'start_date' => (!is_null($item['start_date'])) ? Carbon::parse($item['start_date'])->translatedFormat('M Y') : '?',
                'end_date' => (!is_null($item['end_date'])) ? Carbon::parse($item['end_date'])->translatedFormat('M Y') : '?',
                'members' => abbreviate_number($item['members']),
            ]);
        });
    }

    public function upcoming_animes()
    {
        return collect($this->upcoming_animes)->take(12)->map(function ($item, $key) {
            return collect($item)->merge([
                'start_date' => (!is_null($item['start_date'])) ? Carbon::parse($item['start_date'])->translatedFormat('M Y') : '?',
                'end_date' => (!is_null($item['end_date'])) ? Carbon::parse($item['end_date'])->translatedFormat('M Y') : '?',
                'members' => abbreviate_number($item['members']),
            ]);
        });
    }
}
