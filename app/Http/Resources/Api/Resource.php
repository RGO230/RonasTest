<?php

namespace App\Http\Resources\Api;

use App\Helpers\ApiWeatherHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Resource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'temperature_celsius' => ApiWeatherHelper::convertKelvinsToCelsius($this['temp']),
            'temperature_fahrenheit' => ApiWeatherHelper::convertKelvinsToFahrenheit($this['temp']),
            'humidity' => $this['humidity'],
            'rain_possibility' => $this['rain_possibility'],
            'weather' => $this['weather'],
            'pressure' => $this['pressure'],
            'wind_side' => $this['wind_side'],
            'wind_speed' => $this['wind_speed'] . " м/c",
        ];
    }
}
