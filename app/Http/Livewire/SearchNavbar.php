<?php

namespace App\Http\Livewire;

use App\Services\Contracts\JikanServiceInterface;
use App\ViewModels\SearchViewModel;
use Livewire\Component;

class SearchNavbar extends Component
{
    /**
     * @var string
     */
    public $search;
    
    public function mount()
    {
        $this->search = '';
    }
    
    public function render(JikanServiceInterface $jikan_service)
    {
        $results = [];

        if (strlen($this->search) > 2)
        {
            $results = $jikan_service->searchAnime($this->search);
        }

        $search_view_model = new SearchViewModel($results);

        return view('livewire.search-navbar', $search_view_model);
    }
}
