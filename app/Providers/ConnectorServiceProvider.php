<?php

    namespace App\Providers;

    use App\Services\Connectors\IpInfoConnector;
    use App\Services\Connectors\OpenWeatherConnector;
    use Illuminate\Support\ServiceProvider;

    class ConnectorServiceProvider extends ServiceProvider
    {
        public function boot(): void
        {
            $this->app->singleton(OpenWeatherConnector::class, function ($app) {
                $config = $app['config']['openweather'];
                return new OpenWeatherConnector($config['host']);
            });
            $this->app->singleton(IpInfoConnector::class, function ($app) {
                $config = $app['config']['ipinfo'];
                return new IpInfoConnector($config['host']);
            });


        }
    }
