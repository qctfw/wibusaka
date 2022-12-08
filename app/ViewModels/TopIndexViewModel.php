<?php

namespace App\ViewModels;

use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class TopIndexViewModel extends ViewModel
{
    /**
     * @var Collection
     */
    public $sections;
    
    /**
     * @var Collection
     */
    public $resources;

    public function __construct(Collection $sections, Collection $resources)
    {
        $this->sections = $sections;
        $this->resources = $resources;
    }
}
