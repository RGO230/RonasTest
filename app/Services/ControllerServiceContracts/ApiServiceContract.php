<?php

namespace App\Services\ControllerServiceContracts;

use App\Http\Requests\Api\CityRequest;
use App\Http\Responses\ApiJsonResponse;

interface ApiServiceContract
{
    public function index(CityRequest $request): ApiJsonResponse;
}
