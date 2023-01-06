<?php

namespace App\ViewModels;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class ScheduleViewModel extends ViewModel
{
    public function __construct(
        public Collection $animes,
        public Collection $resources
    )
    {}

    public function active_day()
    {
        return optional($this->animes->first(), function ($anime) {
            return $anime['broadcast']['day'];
        });
    }

    public function animes()
    {
        $animes = $this->animes->reject(function ($anime) {
            return filled(Arr::where($anime['explicit_genres'], function ($value) {
                return in_array($value['mal_id'], [12, 49]);
            }));
        });

        return $animes;
    }
}
