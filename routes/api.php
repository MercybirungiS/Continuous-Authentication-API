<?php

use App\Http\Controllers\BatteryMetricController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\TouchDynamicController;
use App\Http\Controllers\VirtualKeyboardMetricController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['api.auth'])->group(function () {

    // phone routes
    Route::get('phones', [PhoneController::class, 'index']);
    Route::get('phones/{device_id}', [PhoneController::class, 'getByDeviceId']);


    // battery metrics routes
    Route::get('battery-metrics', [BatteryMetricController::class, 'index']);
    Route::get('battery-metrics/{device_id}', [BatteryMetricController::class, 'findbyDeviceId']);
    Route::post('battery-metrics/create', [BatteryMetricController::class, 'create']);


    // touch dynamics metrics routes
    Route::get('touch-dynamics', [TouchDynamicController::class, 'index']);
    Route::get('touch-dynamics/{device_id}', [TouchDynamicController::class, 'findbyDeviceId']);
    Route::post('touch-dynamics/create', [TouchDynamicController::class, 'create']);


    // virtual metrics routes
    Route::get('virtual-keyboard-metrics', [VirtualKeyboardMetricController::class, 'index']);
    Route::get('virtual-keyboard-metrics/{device_id}', [VirtualKeyboardMetricController::class, 'findbyDeviceId']);
    Route::post('virtual-keyboard-metrics/create', [VirtualKeyboardMetricController::class, 'create']);
});
