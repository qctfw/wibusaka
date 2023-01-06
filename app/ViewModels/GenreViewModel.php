<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class GenreViewModel extends ViewModel
{
    public function __construct(
        public $genre,
        public $page,
        public $pagination,
        public $animes,
        public $resources
    )
    {}
}
