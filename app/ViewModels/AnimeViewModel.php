<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;
use Illuminate\Support\Str;

class AnimeViewModel extends ViewModel
{
    public $anime;

    public function __construct($anime)
    {
        $this->anime = $anime;
    }

    public function anime()
    {
        $anime = collect($this->anime)->merge([
            'aired' => [
                'from' => (!is_null($this->anime['aired']['from'])) ? $this->anime['aired']['from']->translatedFormat('d F Y') : '?',
                'to' => (!is_null($this->anime['aired']['to'])) ? $this->anime['aired']['to']->translatedFormat('d F Y') : '?'
            ],
            'scored_by' => abbreviate_number($this->anime['scored_by']),
            'members' => abbreviate_number($this->anime['members']),
            'favorites' => abbreviate_number($this->anime['favorites']),
        ]);
        return $anime;
    }
}
