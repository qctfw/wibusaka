<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class ProducerViewModel extends ViewModel
{
    public function __construct(
        public $producer,
        public $page,
        public $pagination,
        public $animes,
        public $resources
    ) {}

    public function producer()
    {
        $producer = $this->producer->merge([
            'titles' => collect($this->producer['titles'])->keyBy(fn ($item) => strtolower($item['type']))->toArray(),
            'established' => Carbon::parse($this->producer['established'])->translatedFormat('d F Y'),
            'favorites' => abbreviate_number($this->producer['favorites']),
            'count' => abbreviate_number($this->producer['count']),
        ]);

        return $producer;
    }
}
