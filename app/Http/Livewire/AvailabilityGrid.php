<?php

namespace App\Http\Livewire;

use App\Services\Contracts\ResourceServiceInterface;
use Livewire\Component;

class AvailabilityGrid extends Component
{
    /**
     * @var int
     */
    public $mal;

    /**
     * @var bool
     */
    public $loaded;

    public function loadResources()
    {
        $this->loaded = true;
    }

    public function render(ResourceServiceInterface $resource_service)
    {
        return view('livewire.availability-grid', [
            'loaded' => $this->loaded,
            'resources' => $this->loaded ? $resource_service->getByMalId($this->mal) : null
        ]);
    }
}
