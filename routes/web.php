<?php

use App\Http\Controllers\AnimeController;
use App\Http\Controllers\GenreController;
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

Route::group(['as' => 'anime.', 'prefix' => 'anime'], function () {

    Route::group(['as' => 'top.', 'prefix' => 'top'], function () {
        Route::get('rated', [AnimeController::class, 'topRated'])->name('rated');
        // Route::get('airing');
        Route::get('popular', [AnimeController::class, 'topPopular'])->name('popular');
        Route::get('upcoming', [AnimeController::class, 'topUpcoming'])->name('upcoming');
        // Route::get('tv');
        // Route::get('movies');
    });

    Route::get('/season', [AnimeController::class, 'season'])->name('season-current');
    Route::get('/season/{year}/{season}', [AnimeController::class, 'season'])->name('season')->where(['year' => '[0-9]+', 'season' => '[a-z]+']);

    Route::get('/genre/{slug}', [GenreController::class, 'show'])->name('genre');

    Route::get('{id}', [AnimeController::class, 'show'])->name('show')->where('id', '[0-9]+');
});
