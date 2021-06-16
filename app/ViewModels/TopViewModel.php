<?php

namespace App\ViewModels;

use Illuminate\Support\Str;
use Spatie\ViewModels\ViewModel;

class TopViewModel extends ViewModel
{
    public $type;
    public $top_animes;

    public function __construct($type, $top_animes)
    {
        $this->type = $type;
        $this->top_animes = $top_animes;
    }

    public function top_animes()
    {
        return collect($this->top_animes)->map(function ($item, $key) {
            return collect($item)->merge([
                'members' => $this->abbreviateNumber($item['members']),
                'score' => ($item['score'] > 0) ? number_format($item['score'], 2, '.', '') : 'N/A'
            ]);
        });
    }

    private function abbreviateNumber($number): string
    {
        if (is_null($number))
            return '?';

        if (strlen($number) <= 3)
            return $number;

        if (strlen($number) <= 6) {
            $abb_text = 'rb';
        } elseif (strlen($number) <= 9) {
            $abb_text = 'jt';
        } elseif (strlen($number) <= 12) {
            $abb_text = 'M';
        }

        $first_three_numbers = Str::substr($number, 0, 3);

        $decimal_pos = Str::length($number) % 3;
        if ($decimal_pos == 0) {
            return $first_three_numbers . ' ' . $abb_text;
        } else {
            $num_before_comma = Str::substr($first_three_numbers, 0, $decimal_pos);
            $num_after_comma = rtrim(Str::substr($first_three_numbers, $decimal_pos - 3), '0');

            $final_num = Str::length($num_after_comma) == 0 ? $num_before_comma : $num_before_comma . '.' . $num_after_comma;

            return $final_num . ' ' . $abb_text;
        }
    }
}
