<?php

namespace App\Helpers;

use App\Enums\OpenWeatherEnum;

class ApiWeatherHelper
{
    public static function parseWindDegToWorldSide(int $deg) : string
    {
        return match(true) {
            $deg == 0 || $deg == 360 => OpenWeatherEnum::NORTH_WIND_DIRECTION->value,
            $deg > 0 && $deg < 90 => OpenWeatherEnum::NORTH_EAST_WIND_DIRECTION->value,
            $deg == 90 => OpenWeatherEnum::EAST_WIND_DIRECTION->value,
            $deg > 90 && $deg < 180 => OpenWeatherEnum::SOUTH_EAST_WIND_DIRECTION->value,
            $deg == 180 => OpenWeatherEnum::SOUTH_WIND_DIRECTION->value,
            $deg > 180 && $deg < 270 => OpenWeatherEnum::SOUTH_WEST_WIND_DIRECTION->value,
            $deg == 270 => OpenWeatherEnum::WEST_WIND_DIRECTION->value,
            $deg > 270 && $deg < 360 => OpenWeatherEnum::NORTH_WEST_WIND_DIRECTION->value,
            default => "Неизвестное направление",
        };
    }
    public static function getWeatherType(string $weatherType) : string
    {
        return match (true){
            $weatherType == "Rain" => OpenWeatherEnum::RAIN->value,
            $weatherType == "Clouds" => OpenWeatherEnum::CLOUDS->value,
            $weatherType == "Drizzle" => OpenWeatherEnum::DRIZZLE->value,
            $weatherType == "Fog" => OpenWeatherEnum::FOG->value,
            $weatherType == "Clear" => OpenWeatherEnum::CLEAR->value,
            $weatherType == "Thunderstorm" => OpenWeatherEnum::THUNDERSTORM->value,
            $weatherType == "Snow" => OpenWeatherEnum::SNOW->value,
            default => "Неизвестная погода",
        };
    }

    public static function convertKelvinsToFahrenheit(int $temperature): int
    {
        return round( $temperature * 1.8 - 459.67);
    }

    public static function convertKelvinsToCelsius(int $temperature): int
    {
        return $temperature - 273;
    }
}
