<?php

namespace App\Http\Controllers;

use App\ViewModels\MainPageViewModel;
use Illuminate\Support\Facades\Storage;

class MainPageController extends Controller
{
    public function index()
    {
        $quotes = Storage::disk('local')->get('main-page-title-randomizer.json');
        $quotes = json_decode($quotes, true);

        return view('index', new MainPageViewModel($quotes));
    }
}
