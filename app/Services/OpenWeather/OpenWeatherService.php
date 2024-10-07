<?php

namespace App\Services\OpenWeather;

use App\Helpers\ApiWeatherHelper;
use App\Services\Connectors\OpenWeatherConnector;
use App\Services\OpenWeather\Contracts\OpenWeatherContract;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OpenWeatherService implements OpenWeatherContract
{
    private string $apiKey;

    public function __construct(private OpenWeatherConnector $connector)
    {
        $this->apiKey = config('openweather.api_key');
    }
    public function getWeather(string $city) :Collection
    {
        $query = array ('q' => $city) + array ('appid' => $this->apiKey);

            $response = Http::get(
                $this->connector->constructUrl(config('openweather.get_weather')),
                $query
            );
            if($response->getStatusCode() == 404){
                return collect();
            }
            $weatherConditions = $response['list'][0];

            $result = array(
                'temp'=> round($weatherConditions['main']['temp']),
                'humidity'=> $weatherConditions['main']['humidity'],
                'pressure' => $weatherConditions['main']['pressure'],
                'weather' => ApiWeatherHelper::getWeatherType($weatherConditions['weather'][0]['main']),
                'wind_side' => ApiWeatherHelper::parseWindDegToWorldSide($weatherConditions['wind']['deg']),
                'wind_speed' => round($weatherConditions['wind']['speed']),
                'rain_possibility' => $weatherConditions['pop']
            );
            if($response->ok())
            {
                return collect($result);
            }

        return collect(['message' => 'Invalid response', 'status' => $response->status()]);
    }

}
