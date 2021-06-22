<?php

namespace App\Http\Livewire;

use App\Services\Contracts\JikanServiceInterface;
use Livewire\Component;

class RecommendationList extends Component
{
    /**
     * @var int
     */
    public $mal;

    /**
     * @var bool
     */
    public $loaded;

    public function loadRecommendations()
    {
        $this->loaded = true;
    }

    public function render(JikanServiceInterface $jikan_service)
    {
        return view('livewire.recommendation-list', [
            'loaded' => $this->loaded,
            'recommendations' => $this->loaded ? $jikan_service->getAnimeRecommendations($this->mal) : null
        ]);
    }
}
