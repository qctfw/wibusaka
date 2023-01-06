<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class SearchViewModel extends ViewModel
{
    public function __construct(
        public $results,
        public $resources = null
    )
    {}

    public function results()
    {
        return collect($this->results)->where('rated', '!=', 'Rx');
    }
}
