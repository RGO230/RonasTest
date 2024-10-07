<?php
//
//namespace Tests\Feature;
//
//use App\Services\Connectors\OpenWeatherConnector;
//use App\Services\OpenWeather\Contracts\OpenWeatherContract;
//use App\Services\OpenWeather\OpenWeatherService;
//use Illuminate\Foundation\Testing\RefreshDatabase;
//use Illuminate\Foundation\Testing\WithFaker;
//use Illuminate\Support\Collection;
//use Illuminate\Support\Facades\Http;
//use Tests\TestCase;
//
//class OpenWeatherTest extends TestCase
//{
//    /**
//     * A basic feature test example.
//     */
//    private OpenWeatherService $service;
//    private OpenWeatherConnector $connector;
//
//    protected function setUp(): void
//    {
//        parent::setUp();
//
//        // Инициализация зависимостей
//        $this->connector = $this->createMock(OpenWeatherConnector::class);
//        $this->service = new OpenWeatherService($this->connector);
//    }
//
//    public function testGetWeatherReturnsCollectionOnSuccess()
//    {
//
////        Http::fake([
////            '*' => Http::sequence()->push(['temp' => 20, 'weather' => 'Clear']),
////        ]);
//        $this->connector
//            ->method('constructUrl')
//            ->willReturn('https://api.openweathermap.org/data/2.5/forecast');
//
//        $result = $this->service->getWeather('Воронеж');
//
////        $this->assertInstanceOf(Collection::class, $result);
////        $this->assertEquals(20, $result['temp']);
//    }
//}
