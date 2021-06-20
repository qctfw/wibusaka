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

Route::get('/', [AnimeController::class, 'index'])->name('index');

Route::group(['as' => 'top.', 'prefix' => 'top'], function () {
    Route::get('rated/{page?}', [AnimeController::class, 'topRated'])->name('rated');
    // Route::get('airing');
    Route::get('popular/{page?}', [AnimeController::class, 'topPopular'])->name('popular');
    Route::get('upcoming/{page?}', [AnimeController::class, 'topUpcoming'])->name('upcoming');
    // Route::get('tv');
    // Route::get('movies');
});

Route::get('/season', [AnimeController::class, 'season'])->name('anime.season-current');
Route::get('/season/{year}/{season}', [AnimeController::class, 'season'])->name('anime.season')->where(['year' => '[0-9]+', 'season' => '[a-z]+']);

Route::get('/anime/{id}', [AnimeController::class, 'show'])->name('anime.show');
