<?php

use App\Api\V1\Http\Controllers\Auth\AuthController;
use App\Api\V1\Http\Controllers\Contract\ContractController;
use App\Api\V1\Http\Controllers\Driver\DriverController;
use App\Api\V1\Http\Controllers\Nany\NanyController;
use App\Api\V1\Http\Controllers\Parent\ParentController;
use App\Api\V1\Http\Controllers\Trip\TripController;
use App\Api\V1\Http\Controllers\TripDetail\TripDetailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::controller(App\Api\V1\Http\Controllers\Notification\UpdateDeviceTokenController::class)
    ->prefix('/update-device-token')
    ->as('update_device_token.')
    ->group(function () {
        Route::put('/', 'updateDeviceToken')->name('update_device_token');
    });

Route::controller(App\Api\V1\Http\Controllers\Auth\ChangePasswordController::class)
    ->prefix('/change-password')
    ->as('change_password.')
    ->group(function () {
        Route::put('/', 'changePassword')->name('change_password');
    });

Route::fallback(function () {
    return response()->json([
        'status' => 404,
        'message' => __('Không tìm thấy đường dẫn.')
    ], 404);
});
