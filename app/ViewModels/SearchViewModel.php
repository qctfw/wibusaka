<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;
use Illuminate\Support\Str;

class SearchViewModel extends ViewModel
{
    public $results;
    
    public function __construct($results)
    {
        $this->results = $results;
    }

    public function results()
    {
        return collect($this->results)->where('rated', '!=', 'Rx')->map(function ($item, $key) {
            return collect($item)->merge([
                'score' => ($item['score'] > 0) ? number_format($item['score'], 2, '.', '') : 'N/A',
                'start_date' => (!is_null($item['start_date'])) ? Carbon::parse($item['start_date'])->translatedFormat('M Y') : '?',
                'end_date' => (!is_null($item['end_date'])) ? Carbon::parse($item['end_date'])->translatedFormat('M Y') : '?',
                'members' => $this->abbreviateNumber($item['members'])
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
