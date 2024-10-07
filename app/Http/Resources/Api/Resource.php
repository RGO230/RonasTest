<?php

namespace App\Http\Resources\Api;

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
            'temperature_celsius' => $this['temp'] - 273,
            'temperature_fahrenheit' => round($this['temp'] * 1.8 - 459.67),
            'humidity' => $this['humidity'],
            'rain_possibility' => $this['rain_possibility'],
            'weather' => $this['weather'],
            'pressure' => $this['pressure'],
            'wind_side' => $this['wind_side'],
            'wind_speed' => $this['wind_speed'] . " м/c",
        ];
    }
}
