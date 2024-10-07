<?php

namespace App\Services;

use App\Enums\StatusEnum;
use App\Http\Requests\Api\CityRequest;
use App\Http\Resources\Api\Resource;
use App\Http\Responses\ApiJsonResponse;
use App\Services\ControllerServiceContracts\ApiServiceContract;
use App\Services\IpInfo\Contracts\IpInfoContract;
use App\Services\OpenWeather\Contracts\OpenWeatherContract;
use Nette\Schema\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ApiService implements ApiServiceContract
{
    public function __construct(private OpenWeatherContract $openWeatherApi, private IpInfoContract $ipInfoApi)
    {
    }

    public function index(CityRequest $request): ApiJsonResponse
    {
        $city = $request->has('city') ? $request->city : $this->ipInfoApi->getInfo($request->ip());
        $weatherInfo = $this->openWeatherApi->getWeather($city);
        if ($weatherInfo->isEmpty()) {
            return new ApiJsonResponse(
                404,
                StatusEnum::ERR,
                "Кажется, такого города нет",
                data: []
            );
        }
        return new ApiJsonResponse(200, StatusEnum::OK, "", data: new Resource($weatherInfo));
    }
}
