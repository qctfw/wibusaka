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
                    'rating' => $this->formatRating($this->anime['rating']),
                    'scored_by' => abbreviate_number($this->anime['scored_by']),
                    'rank' => number_format($this->anime['rank']),
                    'popularity' => number_format($this->anime['popularity']),
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

    private function formatRating(string $rating_input)
    {
        $rating['rating'] = explode(' - ', $rating_input)[0];

        $rating['note'] = null;
        switch ($rating['rating']) {
            case 'G':
                $rating['note'] = 'Anime ini dapat ditonton oleh semua umur.';
                break;
            case 'PG':
                $rating['note'] = 'Anime ini dapat ditonton oleh anak-anak dengan bimbingan orang tua.';
                break;
            case 'PG-13':
                $rating['note'] = 'Anime ini dapat ditonton oleh remaja diatas 13 tahun.';
                break;
            case 'R':
                $rating['note'] = 'Anime ini mengandung unsur kekerasan dan bahasa kasar yang hanya dapat ditonton oleh penonton dewasa berusia diatas 17 tahun.';
                break;
            case 'R+':
                $rating['note'] = 'Anime ini mengandung sedikit unsur ketelanjangan yang hanya dapat ditonton oleh penonton dewasa berusia diatas 17 tahun.';
                break;
            case 'Rx':
                $rating['note'] = 'Anime ini mengandung banyak unsur ketelanjangan (Hentai).';
                break;
        }

        return $rating;
    }
}
