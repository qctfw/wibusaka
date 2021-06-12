<?php

use App\Http\Controllers;
use App\Http\Controllers\AnimeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'animes.top');

Route::get('/season', [AnimeController::class, 'index']);

Route::get('/anime/{id}', [AnimeController::class, 'show'])->name('anime.show');
