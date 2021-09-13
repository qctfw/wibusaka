<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;
use Illuminate\Support\Str;

class SearchViewModel extends ViewModel
{
    public $results;
    public $resources;

    public function __construct($results, $resources = null)
    {
        $this->results = $results;
        $this->resources = $resources;
    }

    public function results()
    {
        return collect($this->results)->where('rated', '!=', 'Rx')->map(function ($item, $key) {
            return collect($item)->merge([
                'score' => ($item['score'] > 0) ? number_format($item['score'], 2, '.', '') : 'N/A',
                'start_date' => (!is_null($item['start_date'])) ? Carbon::parse($item['start_date'])->translatedFormat('M Y') : '?',
                'end_date' => (!is_null($item['end_date'])) ? Carbon::parse($item['end_date'])->translatedFormat('M Y') : '?',
                'members' => abbreviate_number($item['members'])
            ]);
        });
    }
}
