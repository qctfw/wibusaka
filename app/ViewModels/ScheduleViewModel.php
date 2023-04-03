<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class ScheduleViewModel extends ViewModel
{
    public function __construct(
        public string $day,
        public Collection $animes,
        public Collection $resources
    )
    {}

    public function day()
    {
        return Carbon::create($this->day)->dayName;
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
