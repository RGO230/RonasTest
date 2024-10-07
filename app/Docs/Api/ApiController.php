<?php

namespace App\Docs\Api;

class ApiController
{
    /**
     * @OA\Get(
     *     path="/get-weather",
     *     summary="Получить данные о погоде в городе",
     *     description="Этот метод возвращает информацию о текущей погоде для указанного города.",
     *     operationId="getWeather",
     *     tags={"Weather"},
     *     @OA\Parameter(
     *         name="city",
     *         in="query",
     *         required=false,
     *         description="Название города для получения данных о погоде",
     *         @OA\Schema(
     *             type="string",
     *             example="Voronezh"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешный ответ",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="OK", description="Статус ответа"),
     *             @OA\Property(property="message", type="string", example="", description="Сообщение ответа"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="temperature_celsius", type="number", example=19, description="Температура в градусах Цельсия"),
     *                 @OA\Property(property="temperature_fahrenheit", type="number", example=66, description="Температура в градусах Фаренгейта"),
     *                 @OA\Property(property="humidity", type="number", example=67, description="Влажность в процентах"),
     *                 @OA\Property(property="rain_possibility", type="number", example=0, description="Вероятность дождя в процентах"),
     *                 @OA\Property(property="weather", type="string", example="Облачно", description="Тип погоды"),
     *                 @OA\Property(property="pressure", type="number", example=1007, description="Давление в гПа"),
     *                 @OA\Property(property="wind_side", type="string", example="Юго-восточный", description="Направление ветра"),
     *                 @OA\Property(property="wind_speed", type="string", example="4 м/c", description="Скорость ветра")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Неверный запрос",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="ERROR", description="Статус ответа"),
     *             @OA\Property(property="message", type="string", example="Кажется, такого города нет", description="Сообщение об ошибке"),
     *            @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(type="object"),
     *                  description = "Тело ответа"
     *              )
     *         )
     *     )
     * )
     */

    public function index()
    {

    }
}
