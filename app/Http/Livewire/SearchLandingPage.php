<?php

namespace App\Http\Livewire;

use App\Services\Contracts\JikanServiceInterface;
use App\Services\Contracts\ResourceServiceInterface;
use App\ViewModels\SearchViewModel;
use Illuminate\Support\Arr;
use Livewire\Component;

class SearchLandingPage extends Component
{
    /**
     * @var string
     */
    public $search;

    public function render(JikanServiceInterface $jikan_service, ResourceServiceInterface $resource_service)
    {
        $results = [];
        $resources = [];

        if (strlen($this->search) > 2)
        {
            $results = $jikan_service->searchAnime($this->search);
            $resources = $resource_service->getByMalIds(Arr::pluck($results, 'mal_id'));
        }

        $search_view_model = new SearchViewModel($results, $resources);

        return view('livewire.search-landing-page', $search_view_model);
    }
}
