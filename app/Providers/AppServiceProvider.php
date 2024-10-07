<?php

namespace App\Providers;

use App\Services\ApiService;
use App\Services\ControllerServiceContracts\ApiServiceContract;
use App\Services\IpInfo\Contracts\IpInfoContract;
use App\Services\IpInfo\IpInfoService;
use App\Services\OpenWeather\Contracts\OpenWeatherContract;
use App\Services\OpenWeather\OpenWeatherService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(OpenWeatherContract::class, OpenWeatherService::class);
        $this->app->singleton(IpInfoContract::class, IpInfoService::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(ApiServiceContract::class, ApiService::class);
    }
}
