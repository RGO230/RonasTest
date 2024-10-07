<?php

namespace App\Helpers;

class ApiWeatherHelper
{
    public static function parseWindDegToWorldSide(int $deg) : string
    {
        return match(true) {
            $deg == 0 || $deg == 360 => "Северный",
            $deg > 0 && $deg < 90 => "Северо-восточный",
            $deg == 90 => "Восточный",
            $deg > 90 && $deg < 180 => "Юго-восточный",
            $deg == 180 => "Южный",
            $deg > 180 && $deg < 270 => "Юго-западный",
            $deg == 270 => "Западный",
            $deg > 270 && $deg < 360 => "Северо-западный",
            default => "Неизвестное направление",
        };
    }
}
