<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class MainPageViewModel extends ViewModel
{
    public $quotes;

    public $selected_quote;

    public function __construct($quotes)
    {
        $this->quotes = $quotes;
    }

    public function selected_quote()
    {
        $quotes = (rand(1, 100) <= 5 || env('TITLE_ABNORMAL_HACK', false)) ? $this->quotes['abnormal'] : $this->quotes['normal'];

        $selected_quote = $quotes[array_rand($quotes)];

        return $selected_quote;
    }
}
