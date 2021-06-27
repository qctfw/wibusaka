<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\ViewModels\ViewModel;

class SeasonViewModel extends ViewModel
{
    public $seasons;

    public $animes;

    public $resources;

    public function __construct($seasons, $animes, $resources)
    {
        $this->seasons = $seasons;
        $this->animes = $animes;
        $this->resources = $resources;
    }

    public function animes()
    {
        $animes = collect($this->animes);
        
        return $animes->where('members', '>', 1000)->where('r18', false)->where('continuing', false)->where('kids', false)->map(function ($item, $key) {
            return collect($item)->merge([
                "airing_start" => (!is_null($item['airing_start'])) ? Carbon::parse($item['airing_start'])->translatedFormat('d F Y') : '?',
                "members" => $this->abbreviateNumber($item['members']),
                "score" => ($item['score'] > 0) ? number_format($item['score'], 2, '.', '') : 'N/A'
            ]);
        });
    }

    private function abbreviateNumber($number): string
    {
        if (is_null($number))
            return '?';

        if (strlen($number) <= 3)
            return $number;
        
        if (strlen($number) <= 6)
        {
            $abb_text = 'rb';
        }
        elseif (strlen($number) <= 9)
        {
            $abb_text = 'jt';
        }
        elseif (strlen($number) <= 12)
        {
            $abb_text = 'M';
        }
        
        $first_three_numbers = Str::substr($number, 0, 3);
        
        $decimal_pos = Str::length($number) % 3;
        if ($decimal_pos == 0)
        {
            return $first_three_numbers . ' ' . $abb_text;
        }
        else
        {
            $num_before_comma = Str::substr($first_three_numbers, 0, $decimal_pos);
            $num_after_comma = rtrim(Str::substr($first_three_numbers, $decimal_pos - 3), '0');

            $final_num = Str::length($num_after_comma) == 0 ? $num_before_comma : $num_before_comma . '.' . $num_after_comma;

            return $final_num . ' ' . $abb_text;
        }
    }
}
