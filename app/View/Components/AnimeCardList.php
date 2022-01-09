<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AnimeCardList extends Component
{
    /**
     * @var array
     */
    private $anime;
    
    /**
     * @var array
     */
    private $resources;

    /**
     * @var int
     */
    private $rank;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($anime, $resources, $rank)
    {
        $this->anime = $anime;
        $this->resources = $resources;
        $this->rank = $rank;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.anime-card-list', [
            'anime' => $this->anime,
            'resources' => $this->resources,
            'rank' => $this->rank
        ]);
    }
}
