<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PaginationLink extends Component
{
    /**
     * @var int
     */
    private $current;

    /**
     * @var int
     */
    private $total;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($current, $total)
    {
        $this->current = $current;
        $this->total = $total;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.pagination-link', [
            'current' => $this->current,
            'total' => $this->total,
            'links' => $this->formatLinks()
        ]);
    }

    /**
     * Format the pagination links.
     * 
     * @return array
     */
    private function formatLinks()
    {
        $links = [];

        if ($this->total <= 5) {
            for ($i=1; $i <= $this->total; $i++) { 
                $links[] = $i;
            }
        }
        else {
            $links = [
                ($this->current < $this->total - 2) ? (($this->current > 2) ? $this->current - 2 : 1) : $this->total - 4,
                ($this->current < $this->total - 2) ? (($this->current > 2) ? $this->current - 1 : 2) : $this->total - 3,
                ($this->current < $this->total - 2) ? (($this->current > 2) ? $this->current : 3) : $this->total - 2,
                ($this->current < $this->total - 2) ? (($this->current > 2) ? $this->current + 1 : 4) : $this->total - 1,
                ($this->current < $this->total - 2) ? (($this->current > 2) ? $this->current + 2 : 5) : $this->total
            ];
        }

        return $links;
    }
}
