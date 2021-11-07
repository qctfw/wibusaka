<?php

namespace App\Http\Livewire;

use App\Exceptions\JikanException;
use App\Services\Contracts\JikanServiceInterface;
use App\ViewModels\SearchViewModel;
use Livewire\Component;

class SearchNavbar extends Component
{
    /**
     * @var string
     */
    public $search;

    /**
     * @var string
     */
    public $message;
    
    public function mount()
    {
        $this->search = '';
    }
    
    public function render(JikanServiceInterface $jikan_service)
    {
        $results = [];
        $this->message = '';

        if (strlen($this->search) > 2)
        {
            try {
                $results = $jikan_service->searchAnime($this->search);
            } catch (JikanException $e) {
                $this->message = __('error.jikan_api');
            }
        }

        $search_view_model = new SearchViewModel($results);

        return view('livewire.search-navbar', $search_view_model);
    }
}
