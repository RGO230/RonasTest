<?php

namespace App\Enums;

enum OpenWeatherEnum: string
{
    case NORTH_WIND_DIRECTION = "Северный";
    case SOUTH_WIND_DIRECTION = "Южный";
    case WEST_WIND_DIRECTION = "Западный";
    case EAST_WIND_DIRECTION = "Восточный";
    case SOUTH_WEST_WIND_DIRECTION = "Юго-западный";
    case SOUTH_EAST_WIND_DIRECTION = "Юго-восточный";
    case NORTH_WEST_WIND_DIRECTION = "Северо-западный";
    case NORTH_EAST_WIND_DIRECTION = "Северо-восток";
    case THUNDERSTORM = "Гроза";
    case DRIZZLE = "Изморось";
    case RAIN = 'Дождь';
    case SNOW = "Снег";
    case CLEAR = "Ясно";
    case FOG = "Туман";
    case CLOUDS = "Облачно";

}
