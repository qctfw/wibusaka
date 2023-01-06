<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class TopViewModel extends ViewModel
{
    public function __construct(
        public $title,
        public $page,
        public $total_page,
        public $top_animes,
        public $resources
    )
    {}
}
