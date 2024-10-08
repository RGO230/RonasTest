<?php

namespace Tests\Feature;

use App\Services\Connectors\IpInfoConnector;
use App\Services\Connectors\OpenWeatherConnector;
use App\Services\IpInfo\IpInfoService;
use App\Services\OpenWeather\OpenWeatherService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class IpInfoTest extends TestCase
{
    private IpInfoService $service;

    protected function setUp(): void
    {
        parent::setUp();

        $connector = $this->createMock(IpInfoConnector::class);
        $connector->method('constructUrl')
            ->willReturn(config('ipinfo.host') . "/{ip}");

        $this->service = new IpInfoService($connector);
    }

    public function testGetInfoSuccess(): void
    {
        Http::fake([
            config('ipinfo.host') . '/*' => Http::response([
                'city' => 'Voronezh'
            ], 200),
        ]);

        $result = $this->service->getInfo(config('ipinfo.mock_ip'));

        $this->assertIsString($result);
        $this->assertEquals('Voronezh', $result);
    }

    public function testGetInfoApiFailure(): void
    {
        Http::fake([
            config('ipinfo.host') . '/*' => Http::response(null, 400), // Симулируем ошибку на стороне API
        ]);

        $service = new IpInfoService(new IpInfoConnector(config('ipinfo.host')));

        $result = $service->getInfo(config('ipinfo.mock_ip'));

        $this->assertInstanceOf(Collection::class, $result);

        $this->assertArrayHasKey('message', $result->toArray());
        $this->assertArrayHasKey('status', $result->toArray());
    }
}
