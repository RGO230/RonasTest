<?php

namespace App\Services\OpenWeather\Contracts;

use Illuminate\Support\Collection;

interface OpenWeatherContract
{
    public function getWeather(string $city): Collection;
}
