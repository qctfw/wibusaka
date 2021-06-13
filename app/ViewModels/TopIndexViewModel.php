<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\ViewModels\ViewModel;

class TopIndexViewModel extends ViewModel
{
    public $top_animes;

    public $upcoming_animes;

    public function __construct($top_animes, $upcoming_animes)
    {
        $this->top_animes = $top_animes;
        $this->upcoming_animes = $upcoming_animes;
    }

    public function top_animes()
    {
        return collect($this->top_animes)->take(10)->map(function ($item, $key) {
            return $this->formatAnime($item);
        });
    }

    public function upcoming_animes()
    {
        return collect($this->upcoming_animes)->take(10)->map(function ($item, $key) {
            return $this->formatAnime($item);
        });
    }

    public function formatAnime($item)
    {
        return [
            'mal_id' => $item['mal_id'],
            'rank' => $item['rank'],
            'title' => $item['title'],
            'url' => $item['url'],
            'image_url' => $item['image_url'],
            'type' => $item['type'],
            'episodes' => $item['episodes'],
            'start_date' => (!is_null($item['start_date'])) ? Carbon::parse($item['start_date'])->translatedFormat('M Y') : '?',
            'end_date' => (!is_null($item['end_date'])) ? Carbon::parse($item['end_date'])->translatedFormat('M Y') : '?',
            'members' => $this->abbreviateNumber($item['members']),
            'score' => $item['score']
        ];
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
