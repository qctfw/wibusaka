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
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(GenreServiceInterface::class, GenreService::class);
        $this->app->bind(JikanServiceInterface::class, JikanService::class);
        $this->app->bind(ResourceServiceInterface::class, ResourceService::class);
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
