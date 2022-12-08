<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class ScheduleViewModel extends ViewModel
{
    /**
     * @var Collection
     */
    public $animes;

    /**
     * @var Collection
     */
    public $resources;

    public function __construct($animes, $resources)
    {
        $this->animes = $animes;
        $this->resources = $resources;
    }

    public function active_day()
    {
        return optional($this->animes->first(), function ($anime) {
            return $anime['broadcast']['day'];
        });
    }

    public function animes()
    {
        $animes = $this->animes->reject(function ($anime) {
            return $anime['explicit_genres']->whereIn('mal_id', [12, 49])->isNotEmpty();
        });

        return $animes;
    }
}
