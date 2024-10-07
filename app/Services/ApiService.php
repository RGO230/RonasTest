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

        try {
            if (!$request->has('city')) {
                $city = $this->ipInfoApi->getInfo("85.192.63.64");
                $weatherInfo = $this->openWeatherApi->getWeather($city);
                return new ApiJsonResponse(200, StatusEnum::OK, "", data: new Resource($weatherInfo));
            }
            $city = $request->city;
            $weatherInfo = $this->ipInfoApi->getInfo($city);
            return new ApiJsonResponse(200, StatusEnum::OK, "", data: new Resource($weatherInfo));
        } catch (\HttpResponseException $e) {
            return new ApiJsonResponse(400, StatusEnum::ERR, $e->getMessage(), data: [
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);
        } catch (NotFoundHttpException $e) {
            return new ApiJsonResponse(404, StatusEnum::ERR, $e->getMessage(), data: [
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);
        } catch (ValidationException $e) {
            return new ApiJsonResponse(422, StatusEnum::ERR, $e->getMessage(), data: [
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);
        }
        return new ApiJsonResponse(500, StatusEnum::ERR, "", data: []);
    }
}
