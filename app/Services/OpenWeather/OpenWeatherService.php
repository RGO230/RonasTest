<?php

namespace App\Services\OpenWeather;

use App\Helpers\ApiWeatherHelper;
use App\Services\Connectors\OpenWeatherConnector;
use App\Services\OpenWeather\Contracts\OpenWeatherContract;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

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
        try {
            $response = Http::get(
                $this->connector->constructUrl(config('openweather.get_weather')),
                $query
            );
            $weatherConditions = $response['list'][0];
            $result = array(
                'temp'=> round($weatherConditions['main']['temp']),
                'humidity'=> $weatherConditions['main']['humidity'],
                'pressure' => $weatherConditions['main']['pressure'],
                'weather' => $weatherConditions['weather'][0]['main'],
                'wind_side' => ApiWeatherHelper::parseWindDegToWorldSide($weatherConditions['wind']['deg']),
                'wind_speed' => round($weatherConditions['wind']['speed']),
                'rain_possibility' => $weatherConditions['pop']
            );
            if ($response->ok()) {
                return collect($result);
            }
        } catch (\Exception $error){
            return collect(response()->json(['message'=>$error->getMessage(),'status'=>$error->getCode()]));
        }
        return collect();
    }

}
