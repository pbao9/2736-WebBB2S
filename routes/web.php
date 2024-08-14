<?php

use App\Admin\Http\Controllers\School\SchoolSearchSelectController;
use App\Http\Controllers\Address\AddressController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Dia chi 
Route::get('/address/districts', [AddressController::class, 'getDistrictsByProvince'])->name('districts');
Route::get('/address/wards', [AddressController::class, 'getWardsByDistrict'])->name('wards');
Route::get('/address/schools-by-district', [SchoolSearchSelectController::class, 'getSchoolsByDistrict'])->name('schools');

Route::controller(App\Http\Controllers\Contact\ContactController::class)
    ->prefix('/lien-he')
    ->as('contact.')
    ->group(function () {
        Route::post('/', 'store')->name('store');
    });


Route::controller(App\Http\Controllers\Auth\ResetPasswordController::class)
    ->prefix('/reset-password')
    ->as('password.reset.')
    ->group(function () {
        Route::get('/edit', 'edit')->name('edit')->middleware('signed');
        Route::put('/update', 'update')->name('update');
        Route::get('/success', 'success')->name('success');
    });


Route::controller(App\Http\Controllers\Home\HomeController::class)
    ->prefix('/')
    ->as('home.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
    });

// Sản phẩm
Route::controller(App\Http\Controllers\Product\ProductController::class)
    ->prefix('/san-pham')
    ->as('product.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
    });

// Quy trình
Route::controller(App\Http\Controllers\Process\ProcessController::class)
    ->prefix('/cach-thuc-hoat-dong')
    ->as('process.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
    });

// Liên hệ
Route::controller(App\Http\Controllers\SinglePage\SinglePageController::class)
    ->as('form.')
    ->group(function () {
        Route::get('/lien-he', 'contact')->name('contact');
        Route::get('/tim-xe', 'findcar')->name('findcar');
    });


// Blog
Route::controller(App\Http\Controllers\Blog\BlogController::class)
    ->prefix('/tin-tuc')
    ->as('blog.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{slug}', 'show')->name('show');
    });

//San phams
Route::controller(App\Http\Controllers\Product\ProductController::class)
    ->prefix('/san-pham')
    ->as('product.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{slug}', 'show')->name('show');
        // Route::get('/review-nhanh-ung-dung-anta-bao-mau-va-website-danh-cho-nha-truong', 'blog1')->name('blog1');
        // Route::get('/dich-vu-dua-don-hoc-sinh-tien-loi-va-linh-hoat', 'blog2')->name('blog2');
        // Route::get('/thue-xe-dua-don-hoc-sinh-cho-con-dich-vu-hay-di-xe-ghep', 'blog3')->name('blog3');
    });


Route::prefix('/search')->as('search.')->group(function () {
    Route::prefix('/select')->as('select.')->group(function () {
        Route::get('/province', [App\Admin\Http\Controllers\Address\Address\Province\ProvinceSearchController::class, 'selectSearch'])->name('province');
        Route::get('/district', [App\Admin\Http\Controllers\Address\Address\District\DistrictSearchController::class, 'selectSearch'])->name('district');
        Route::get('/ward', [App\Admin\Http\Controllers\Address\Address\Ward\WardSearchController::class, 'selectSearch'])->name('ward');
        // Route::get('/school', [App\Http\Controllers\School\SchoolSearchSelectController::class, 'selectSearch'])->name('school');
    });
});





