<?php

use App\Http\Controllers\AnimeController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\TopAnimeController;
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

Route::get('/', [MainPageController::class, 'index'])->name('index');

Route::group(['as' => 'anime.', 'prefix' => 'anime', 'controller' => AnimeController::class], function () {
    Route::get('/', 'index')->name('index');
    
    Route::group(['as' => 'top.', 'prefix' => 'top', 'controller' => TopAnimeController::class], function () {
        Route::get('rated', 'rated')->name('rated');
        Route::get('airing', 'airing')->name('airing');
        Route::get('popular', 'popular')->name('popular');
        Route::get('upcoming', 'upcoming')->name('upcoming');
        // Route::get('tv');
        // Route::get('movies');
    });

    Route::group(['as' => 'genre.', 'prefix' => 'genre', 'controller' => GenreController::class], function () {
        Route::get('/', 'index')->name('index');
        Route::get('{slug}', 'show')->name('show');
    });

    Route::get('/season', 'season')->name('season-current');
    Route::get('/season/{year}/{season}', 'season')->name('season')->whereNumber('year')->whereAlpha('season');

    Route::get('/schedule/{day?}', 'schedule')->name('schedule')->whereAlpha('day');

    Route::get('{id}', 'show')->name('show')->whereNumber('id');
});
