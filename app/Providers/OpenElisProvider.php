<?php

namespace App\Providers;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class OpenElisProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('OpenElisClient', function ($app) {
            return new Client([
                'verify' => false,
                'cert' => base_path('storage/cert.pem'),
                'ssl_key' => base_path('storage/key.pem'),
            ]);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void {}
}
