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
                'aired' => [
                    'from' => (!is_null($item['aired']['from'])) ? $item['aired']['from']->translatedFormat('M Y') : '?',
                    'to' => (!is_null($item['aired']['to'])) ? $item['aired']['to']->translatedFormat('M Y') : '?'
                ],
                'members' => abbreviate_number($item['members']),
            ]);
        });
    }
}
