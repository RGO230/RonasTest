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

        // Мокаем коннектор
        $connector = $this->createMock(IpInfoConnector::class);
        $connector->method('constructUrl')
            ->willReturn(config('ipinfo.host') . "/{ip}");

        // Инициализируем сервис
        $this->service = new IpInfoService($connector);
    }

    public function testGetInfoSuccess(): void
    {
        Http::fake([
            config('ipinfo.host') . '/*' => Http::response([
                'city' => 'Voronezh'
            ], 200),
        ]);

        // Выполняем метод
        $result = $this->service->getInfo('5.101.227.0');

        // Проверяем, что результат — это строка с названием города
        $this->assertIsString($result);
        $this->assertEquals('Voronezh', $result);
    }

    public function testGetInfoApiFailure(): void
    {
        Http::fake([
            config('ipinfo.host') . '/*' => Http::response(null, 500), // Симулируем ошибку на стороне API
        ]);

        $service = new IpInfoService(new IpInfoConnector('http://api.ipinfo.com'));
        $result = $service->getInfo('5.101.227.0');
        // Проверяем, что результат — это коллекция
        $this->assertInstanceOf(Collection::class, $result);

        // Проверяем, что в коллекции присутствуют ключи 'message' и 'status'
        $this->assertArrayHasKey('message', $result->toArray());
        $this->assertArrayHasKey('status', $result->toArray());
    }
}
