<?php

namespace Tests\Unit;

use App\Services\OpenWeather\OpenWeatherService;
use App\Services\Connectors\OpenWeatherConnector;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;
use Tests\TestCase;

class OpenWeatherTest extends TestCase
{
    protected OpenWeatherService $service;
    protected OpenWeatherConnector $mockConnector;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mockConnector = $this->createMock(OpenWeatherConnector::class);
        $this->mockConnector
            ->method('constructUrl')
            ->willReturn(config('openweather.host').'/forecast');

        $this->service = new OpenWeatherService($this->mockConnector);
    }

    public function testGetWeatherSuccess(): void
    {
        Http::fake([
            (config('openweather.host').'/forecast*') => Http::response([
                'list' => [
                    [
                        'main' => [
                            'temp' => 287.2,
                            'humidity' => 88,
                            'pressure' => 996,
                        ],
                        'weather' => [
                            ['main' => 'Clouds']
                        ],
                        'wind' => [
                            'deg' => 220,
                            'speed' => 5.0,
                        ],
                        'pop' => 0.8,
                    ]
                ]
            ], 200),
        ]);


        $result = $this->service->getWeather('Voronezh');

        $this->assertInstanceOf(Collection::class, $result);

        $this->assertArrayHasKey('temp', $result);
        $this->assertArrayHasKey('humidity', $result);
        $this->assertArrayHasKey('pressure', $result);
        $this->assertArrayHasKey('weather', $result);
        $this->assertArrayHasKey('wind_side', $result);
        $this->assertArrayHasKey('wind_speed', $result);
        $this->assertArrayHasKey('rain_possibility', $result);

        $this->assertIsFloat($result['temp']);
        $this->assertIsInt($result['humidity']);
        $this->assertIsInt($result['pressure']);
        $this->assertIsString($result['weather']);
        $this->assertIsString($result['wind_side']);
        $this->assertIsFloat($result['wind_speed']);
        $this->assertIsFloat($result['rain_possibility']);
    }
    public function testGetWeatherApiFailure(): void
    {
        Http::fake([
            (config('openweather.host').'/forecast*') => Http::response(null, 404),
        ]);

        $result = $this->service->getWeather('Voronezh');

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertTrue($result->isEmpty());
    }
}
