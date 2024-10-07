<?php
return [
    'api_key' => env('OPENWEATHER_API_KEY', '3076a202dee79588adabc7e206dca045'),
    'host' => env ('OPENWEATHER_HOST', 'https://api.openweathermap.org/data/2.5/'),
    'get_weather' => env('OPENWEATHER_GET_WEATHER', "/forecast?q={city}&appid={key}"),
];
