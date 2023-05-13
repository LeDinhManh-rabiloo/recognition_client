<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Yahoo\ApiYahooService;

class ApiYahooServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ApiYahooService::class, function ($app) {
            return new ApiYahooService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
