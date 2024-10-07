<?php
//
//namespace Tests\Feature;
//
//use App\Services\Connectors\IpInfoConnector;
//use App\Services\Connectors\OpenWeatherConnector;
//use App\Services\IpInfo\IpInfoService;
//use App\Services\OpenWeather\OpenWeatherService;
//use Illuminate\Foundation\Testing\RefreshDatabase;
//use Illuminate\Foundation\Testing\WithFaker;
//use Illuminate\Support\Collection;
//use Tests\TestCase;
//
//class IpInfoTest extends TestCase
//{
//    /**
//     * A basic feature test example.
//     */
//    protected function setUp(): void
//    {
//        parent::setUp();
//
//        // Инициализация зависимостей
//        $this->connector = $this->createMock(IpInfoConnector::class);
//        $this->service = new IpInfoService($this->connector);
//    }
//
//    public function testGetWeatherReturnsCollectionOnSuccess()
//    {
//
////        Http::fake([
////            '*' => Http::sequence()->push(['temp' => 20, 'weather' => 'Clear']),
////        ]);
//
//        $this->connector
//            ->method('constructUrl')
//            ->willReturn('https://api.ipinfo.info/api');
//
//        $result = $this->service->getInfo('8.8.8.8');
//
//        $this->assertInstanceOf(Collection::class, $result);
////        $this->assertEquals(20, $result['temp']);
//    }
//}
