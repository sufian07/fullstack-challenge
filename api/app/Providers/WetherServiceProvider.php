<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\BL\Wether\IWetherService;
use App\BL\Wether\ApiWetherGovService;

class WetherServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IWetherService::class, ApiWetherGovService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
