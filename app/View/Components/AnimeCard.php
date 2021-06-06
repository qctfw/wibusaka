<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AnimeCard extends Component
{
    /**
     * @var array
     */
    private $anime;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($anime)
    {
        $this->anime = $anime;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.anime-card', [
            'anime' => $this->anime
        ]);
    }
}
