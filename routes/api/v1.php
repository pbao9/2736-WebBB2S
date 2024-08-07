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

//parents
Route::prefix('parents')->controller(ParentController::class)
    ->group(function () {
        Route::post('/register', 'register')->name('register');
        Route::post('/logout', 'logout')->name('logout');
        Route::post('/refresh', 'refresh')->name('refresh');
        Route::post('/', 'update')->name('update');
        Route::get('/trips', 'getTripsByParent');
        Route::get('/trip-detail', 'tripDetail');
    });

//nany
Route::prefix('nannies')->controller(NanyController::class)
    ->group(function () {
        Route::post('/', 'update')->name('update');
    });

//driver
Route::prefix('drivers')->controller(DriverController::class)
    ->group(function () {
        Route::post('/', 'update')->name('update');
    });


//staff
Route::controller(App\Api\V1\Http\Controllers\Staff\StaffController::class)
    ->prefix('/staff')
    ->group(function () {
        Route::get('/schedule', 'getSchedule');
        Route::post('/schedule-off', 'requestDayOff');
        Route::delete('/schedule-off/{id}', 'delete');
        Route::post('/restore/{id}', 'restore');
    });

//auth
Route::prefix('auth')->controller(AuthController::class)
    ->group(function () {
        Route::post('/login', 'login')->name('login');
        Route::post('/refresh', 'refresh')->name('refresh');
        Route::get('/', 'show')->name('show');
    });

//Trip
Route::prefix('trips')->controller(TripController::class)
    ->group(function () {
        Route::get('/by-staff', 'getTripsByStaff');
        Route::get('/{code}', 'show');
        Route::post('/start', 'startTrip');
        Route::post('/start-from-school', 'startTripFromSchool');
        Route::post('/end', 'endTrip');
        Route::post('/arrival-school', 'updateStudentArrivalSchool');
        Route::post('/location', 'updateLocation');

    });

//Trip detail
Route::prefix('trip-detail')->controller(TripDetailController::class)
    ->group(function () {
        Route::post('/pickup', 'pickupStatus');
        Route::post('/notify-arrival', 'notifyParentOfArrival');
        Route::post('/end-trip', 'endTrip');
        Route::post('/skip-student', 'skipStudent');
    });

//Contract
Route::prefix('contracts')->controller(ContractController::class)
    ->group(function () {
        Route::get('/', 'view')->name('view');
        Route::get('/show/{id}', 'getDetail')->name('show');

    });

//Notification
Route::controller(App\Api\V1\Http\Controllers\Notification\NotificationController::class)
    ->prefix('/notes')
    ->as('note.')
    ->group(function () {
        Route::get('/detail/{id}', 'detail')->name('detail');
        Route::get('/parent', 'getParentNotifications')->name('getNotiParent');
        Route::get('/driver', 'getDriverNotifications')->name('getNotiDriver');
        Route::get('/nany', 'getNanyNotifications')->name('getNotiNany');
        // Route::delete('/destroy/{id}', 'destroy')->name('destroy');
        // Route::patch('/status/read/{id}', 'updateStatusRead')->name('updateStatusRead');

});

//post category
Route::controller(App\Api\V1\Http\Controllers\PostCategory\PostCategoryController::class)
    ->prefix('/posts-categories')
    ->as('post_catogery.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/show/{id}', 'show')->name('show');
    });

//posts
Route::controller(App\Api\V1\Http\Controllers\Post\PostController::class)
    ->prefix('/posts')
    ->as('post.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/featured', 'featured')->name('featured');
        Route::get('/show/{id}', 'show')->name('show');
        Route::get('/related/{id}', 'related')->name('related');
    });


//student
Route::controller(App\Api\V1\Http\Controllers\Student\StudentController::class)
    ->prefix('/students')
    ->as('student.')
    ->group(function () {
        Route::get('/show/{id}', 'show')->name('show');
        Route::get('/', 'view')->name('view');
        Route::get('/schedule/{id}', 'getSchedule')->name('schedule');
        Route::post('/schedule-off', 'requestDayOff');
        Route::post('/update', 'update')->name('update');
        Route::delete('/schedule-off', 'delete')->name('delete');
    });

//slider
Route::controller(App\Api\V1\Http\Controllers\Slider\SliderController::class)
    ->prefix('/slider')
    ->as('slider.')
    ->group(function () {
        Route::get('/show', 'show')->name('show');
        Route::get('/', 'view')->name('view');
    });

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
