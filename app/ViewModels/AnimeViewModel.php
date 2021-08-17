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
                    'scored_by' => abbreviate_number($this->anime['scored_by']),
                    'rank' => number_format($this->anime['rank']),
                    'popularity' => number_format($this->anime['popularity']),
                    'premiered' => $this->formatPremiered($this->anime['premiered']),
                    'members' => abbreviate_number($this->anime['members']),
                    'favorites' => abbreviate_number($this->anime['favorites']),
                    'studios' => collect($this->anime['studios']),
                    'genres' => collect($this->anime['genres'])
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

    private function formatPremiered(?string $premiered): ?array
    {
        if (is_null($premiered))
        {
            return null;
        }

        $season = explode(' ', $premiered);

        return [
            'full' => $premiered,
            'season' => Str::lower($season[0]),
            'year' => $season[1]
        ];
    }
}
