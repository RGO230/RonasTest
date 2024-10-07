<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('get-weather', [\App\Http\Controllers\V1\ApiController::class,'index'])->name('api.weather.index');

