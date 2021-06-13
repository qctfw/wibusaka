<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\ViewModels\ViewModel;

class SeasonViewModel extends ViewModel
{
    public $season_year;
    
    public $season_name;

    public $animes;

    public function __construct($season_year, $season_name, $animes)
    {
        $this->season_year = $season_year;
        $this->season_name = $season_name;
        $this->animes = $animes;
    }

    public function animes()
    {
        $animes = collect($this->animes)->map(function ($item, $key) {
            return [
                "mal_id" => $item['mal_id'],
                "title" => $item['title'],
                "image_url" => $item['image_url'],
                "synopsis" => $item['synopsis'],
                "type" => $item['type'],
                "airing_start" => (!is_null($item['airing_start'])) ? Carbon::parse($item['airing_start'])->translatedFormat('d F Y') : '?',
                "episodes" => $item['episodes'],
                "members" => $this->abbreviateNumber($item['members']),
                "genres" => $item['genres'],
                "source" => $item['source'],
                "producers" => $item['producers'],
                "score" => $item['score']
            ];
        });
        return $animes;
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
