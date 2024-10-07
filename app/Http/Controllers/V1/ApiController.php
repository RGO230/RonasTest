<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CityRequest;
use App\Http\Responses\ApiJsonResponse;
use App\Services\ApiService;
use App\Services\ControllerServiceContracts\ApiServiceContract;
use App\Services\IpInfo\Contracts\IpInfoContract;
use App\Services\OpenWeather\Contracts\OpenWeatherContract;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function __construct(private ApiServiceContract $service){}

    public function index(CityRequest $request):ApiJsonResponse
    {
        return $this->service->index($request);
    }
}
