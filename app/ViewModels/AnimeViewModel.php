<?php

namespace App\ViewModels;

use App\Datas\AnimeData;
use Spatie\ViewModels\ViewModel;

class AnimeViewModel extends ViewModel
{
    public function __construct(
        public AnimeData $anime
    )
    {}
}
