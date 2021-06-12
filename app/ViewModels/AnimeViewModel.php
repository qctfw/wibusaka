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
        $anime = collect($this->anime)
                ->merge([
                    'aired' => [
                        'from' => (!is_null($this->anime['aired']['from'])) ? Carbon::parse($this->anime['aired']['from'])->translatedFormat('d F Y') : '?',
                        'to' => (!is_null($this->anime['aired']['to'])) ? Carbon::parse($this->anime['aired']['to'])->translatedFormat('d F Y') : '?'
                    ],
                    'status' => $this->formatStatus($this->anime['status']),
                    'rating' => explode(' - ', $this->anime['rating'])[0],
                    'scored_by' => $this->abbreviateNumber($this->anime['scored_by']),
                    'rank' => $this->abbreviateNumber($this->anime['rank']),
                    'popularity' => $this->abbreviateNumber($this->anime['popularity']),
                    'members' => $this->abbreviateNumber($this->anime['members']),
                    'favorites' => $this->abbreviateNumber($this->anime['favorites']),
                ])
                ->except(['request_hash', 'request_hashed', 'request_cached', 'request_cache_expiry']);
        return $anime;
    }

    private function formatStatus(string $status): string
    {
        $result = '';
        switch ($status) {
            case 'Not yet aired':
                $result = 'Belum Tayang';
                break;
            case 'Currently Airing':
                $result = 'Sedang Tayang';
                break;
            case 'Finished Airing':
                $result = 'Sudah Tayang';
                break;
        }

        return $result;
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
