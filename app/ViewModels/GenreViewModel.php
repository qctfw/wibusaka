<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class GenreViewModel extends ViewModel
{
    public $genre;

    public $page;

    public $pagination;

    public $details;

    public $animes;

    public $resources;

    public function __construct($genre, $page, $pagination, $animes, $resources)
    {
        $this->genre = $genre;
        $this->page = $page;
        $this->pagination = $pagination;
        $this->animes = $animes;
        $this->resources = $resources;
    }
}
