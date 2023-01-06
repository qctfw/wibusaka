<?php

namespace App\ViewModels;

use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class TopIndexViewModel extends ViewModel
{
    public function __construct(
        public Collection $sections,
        public Collection $resources
    )
    {}
}
