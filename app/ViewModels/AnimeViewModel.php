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
                    'duration' => $this->formatDuration($this->anime['duration']),
                    'scored_by' => abbreviate_number($this->anime['scored_by']),
                    'rank' => number_format($this->anime['rank']),
                    'popularity' => number_format($this->anime['popularity']),
                    'premiered' => $this->formatPremiered($this->anime['season'], $this->anime['year']),
                    'members' => abbreviate_number($this->anime['members']),
                    'favorites' => abbreviate_number($this->anime['favorites']),
                    'studios' => collect($this->anime['studios']),
                    'genres' => collect($this->anime['genres']),
                    'openings' => $this->formatOPEDTheme($this->anime['openings']),
                    'endings' => $this->formatOPEDTheme($this->anime['endings']),
                    'external_links' => [],
                ])
                ->except(['request_hash', 'request_hashed', 'request_cached', 'request_cache_expiry']);
        return $anime;
    }

    private function formatDuration(string $duration): string
    {
        if ($duration == 'Unknown')
        {
            return '';
        }

        return trim(Str::replace(['hr', 'min', 'per ep'], ['jam', 'menit', ''], $duration));
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

    private function formatPremiered(?string $season, ?int $year): ?string
    {
        if (is_null($season))
        {
            return null;
        }

        return Str::ucfirst($season) . ' ' . $year;
    }

    private function formatOPEDTheme(array $themes): array
    {
        if (count($themes) < 1 || Str::contains($themes[0], 'Help improve our database')) {
            return [];
        }

        return $themes;
    }

    private function formatExternalLinks(array $links): array
    {
        return collect($links)->mapWithKeys(function ($item, $key) {
            if ($item['name'] == 'Official Site') {
                $item['name'] = 'Website';
            }
            return [ $item['name'] => $item['url'] ];
        })->toArray();
    }
}
