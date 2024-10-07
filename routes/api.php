<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\ApiController;

Route::get('get-weather', [ApiController::class,'index'])->name('api.weather.index');
