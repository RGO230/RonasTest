<?php

use App\Http\Requests\Api\CityRequest;
use App\Services\ApiService;

// Замените на ваш контроллер
use App\Services\OpenWeather\OpenWeatherService;

// Замените на ваш сервис
use App\Services\IpInfo\IpInfoService;

// Замените на ваш сервис
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;
use App\Http\Responses\ApiJsonResponse;
use Mockery;
use App\Enums\StatusEnum;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Http\Resources\Api\Resource;

class ApiServiceTest extends TestCase
{


    protected $openWeatherApi;
    protected $ipInfoApi;

    protected $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->openWeatherApi = Mockery::mock(OpenWeatherService::class);
        $this->ipInfoApi = Mockery::mock(IpInfoService::class);
        $this->service = new ApiService($this->openWeatherApi, $this->ipInfoApi);
    }

    public function testGetWeatherInfoByCity(): void
    {
        $request = new CityRequest(['city' => 'London']);

        $weatherInfo = collect([
            "temp" => 289.0,
            "humidity" => 79,
            "pressure" => 997,
            "weather" => "Облачно",
            "wind_side" => "Юго-восточный",
            "wind_speed" => 3.0,
            "rain_possibility" => 0,
        ]);

        $resource = new Resource($weatherInfo);
        $this->openWeatherApi
            ->expects('getWeather')
            ->andReturn($weatherInfo);

        $response = $this->service->index($request);

        $this->assertInstanceOf(ApiJsonResponse::class, $response);
        $this->assertEquals(StatusEnum::OK, $response->status);
        $this->assertInstanceOf(Resource::class, $response->data);

        $this->assertEquals($resource, $response->data);
    }

    public function testGetWeatherInfoByIp(): void
    {
        $request = new CityRequest();


        $this->ipInfoApi
            ->expects('getInfo')
            ->andReturn('Moscow');

        $weatherInfo = collect([
            "temp" => 289.0,
            "humidity" => 79,
            "pressure" => 997,
            "weather" => "Облачно",
            "wind_side" => "Юго-восточный",
            "wind_speed" => 3.0,
            "rain_possibility" => 0,
        ]);

        $resource = new Resource($weatherInfo);
        $this->openWeatherApi
            ->expects('getWeather')
            ->andReturn($weatherInfo);

        $response = $this->service->index($request);
        $this->assertInstanceOf(ApiJsonResponse::class, $response);
        $this->assertEquals(StatusEnum::OK, $response->status);
        $this->assertInstanceOf(Resource::class, $response->data);
        $this->assertEquals($resource, $response->data);
    }

    public function testCityNotFound(): void
    {
        $request = new CityRequest(['city' => 'NonExistentCity']);

        $this->openWeatherApi
            ->expects('getWeather')
            ->andReturn(collect());

        $response = $this->service->index($request);
        $this->assertInstanceOf(ApiJsonResponse::class, $response);
        $this->assertEquals(StatusEnum::ERR, $response->status);
        $this->assertEquals('Кажется, такого города нет', $response->message);
    }

}
