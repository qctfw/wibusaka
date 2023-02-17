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
     * @var array<class-string, class-string>
     */
    public $bindings = [
        GenreServiceInterface::class => GenreService::class,
        JikanServiceInterface::class => JikanService::class,
        ResourceServiceInterface::class => ResourceService::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if(config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
