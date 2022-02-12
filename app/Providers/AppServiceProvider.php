<?php

namespace App\Providers;

use App\Services\Contracts\GenreServiceInterface;
use App\Services\Contracts\JikanServiceInterface;
use App\Services\Contracts\ResourceServiceInterface;
use App\Services\GenreService;
use App\Services\JikanService;
use App\Services\ResourceService;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        GenreServiceInterface::class => GenreService::class,
        JikanServiceInterface::class => JikanService::class,
        ResourceServiceInterface::class => ResourceService::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(config('app.env') === 'production') {
            URL::forceScheme('https');
        }
        debugbar()->disable();
    }
}
