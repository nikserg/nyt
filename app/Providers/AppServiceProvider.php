<?php

namespace App\Providers;

use App\NytApi\Transport\CachedHttpTransport;
use App\NytApi\Transport\HttpTransport;
use App\NytApi\Transport\TransportInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TransportInterface::class, function ($app) {
            //return new HttpTransport(config('nyt.apiKey'), config('nyt.host'));
            return new CachedHttpTransport(config('nyt.apiKey'), config('nyt.host'), config('nyt.cacheTTL'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
