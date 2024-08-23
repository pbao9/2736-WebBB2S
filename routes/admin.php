<?php

use App\Admin\Http\Controllers\Address\AddressController;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Admin\Http\Controllers\Home\HomeController::class, 'index']);

// login
Route::controller(App\Admin\Http\Controllers\Auth\LoginController::class)
    ->middleware('guest:admin')
    ->prefix('/login')
    ->as('login.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'login')->name('post');
    });

Route::group(['middleware' => 'admin.auth.admin:admin'], function () {
    //school
    Route::controller(App\Admin\Http\Controllers\School\SchoolController::class)
        ->prefix('/schools')
        ->as('school.')
        ->group(function () {
            Route::group(['middleware' => ['permission:createSchool', 'auth:admin']], function () {
                Route::get('/add', 'create')->name('create');
                Route::post('/add', 'store')->name('store');
            });
            Route::group(['middleware' => ['permission:viewSchool', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/download/school-file', 'download')->name('download');
                Route::get('/edit/{id}', 'edit')->name('edit');
            });

            Route::group(['middleware' => ['permission:updateSchool', 'auth:admin']], function () {
                Route::put('/edit', 'update')->name('update');
            });

            Route::group(['middleware' => ['permission:deleteSchool', 'auth:admin']], function () {
                Route::delete('/delete/{id}', 'delete')->name('delete');
            });
        });

    // Province
    Route::controller(App\Admin\Http\Controllers\Address\Address\Province\ProvinceController::class)
        ->prefix('/province')
        ->as('province.')
        ->group(function () {
            Route::group(['middleware' => ['permission:createProvince', 'auth:admin']], function () {
                Route::get('/add', 'create')->name('create');
                Route::post('/add', 'store')->name('store');
            });
            Route::group(['middleware' => ['permission:viewProvince', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/edit/{id}', 'edit')->name('edit');
            });

            Route::group(['middleware' => ['permission:updateProvince', 'auth:admin']], function () {
                Route::put('/edit', 'update')->name('update');
            });

            Route::group(['middleware' => ['permission:deleteProvince', 'auth:admin']], function () {
                Route::delete('/delete/{id}', 'delete')->name('delete');
            });
        });

    // District
    Route::controller(App\Admin\Http\Controllers\Address\Address\District\DistrictController::class)
        ->prefix('/district')
        ->as('district.')
        ->group(function () {
            Route::group(['middleware' => ['permission:createDistrict', 'auth:admin']], function () {
                Route::get('/add', 'create')->name('create');
                Route::post('/add', 'store')->name('store');
            });
            Route::group(['middleware' => ['permission:viewDistrict', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/edit/{id}', 'edit')->name('edit');
            });

            Route::group(['middleware' => ['permission:updateDistrict', 'auth:admin']], function () {
                Route::put('/edit', 'update')->name('update');
            });

            Route::group(['middleware' => ['permission:deleteDistrict', 'auth:admin']], function () {
                Route::delete('/delete/{id}', 'delete')->name('delete');
            });
        });


    //Notification
    Route::controller(App\Admin\Http\Controllers\Notification\NotificationController::class)
        ->prefix('/notifications')
        ->as('notification.')
        ->group(function () {
            Route::get('/not-read-admin', 'getNotificationsForAdmin')->name('getNotificationAdmin');
            Route::patch('/status', 'updateStatus')->name('status');
            Route::post('/update-device-token', 'updateDeviceToken')->name('updateDeviceToken');
            Route::group(['middleware' => ['permission:createNotification', 'auth:admin']], function () {
                Route::get('/add', 'create')->name('create');
                Route::post('/add', 'store')->name('store');
            });
            Route::group(['middleware' => ['permission:viewNotification', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/edit/{id}', 'edit')->name('edit');
            });

            Route::group(['middleware' => ['permission:updateNotification', 'auth:admin']], function () {
                Route::put('/edit', 'update')->name('update');
            });

            Route::group(['middleware' => ['permission:deleteNotification', 'auth:admin']], function () {
                Route::delete('/delete/{id}', 'delete')->name('delete');
            });
        });

    //Post category
    Route::prefix('/posts-categories')->as('post_category.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\PostCategory\PostCategoryController::class)->group(function () {
            Route::group(['middleware' => ['permission:createPostCategory', 'auth:admin']], function () {
                Route::get('/them', 'create')->name('create');
                Route::post('/them', 'store')->name('store');
            });
            Route::group(['middleware' => ['permission:viewPostCategory', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/sua/{id}', 'edit')->name('edit');
            });

            Route::group(['middleware' => ['permission:updatePostCategory', 'auth:admin']], function () {
                Route::put('/sua', 'update')->name('update');
            });

            Route::group(['middleware' => ['permission:deletePostCategory', 'auth:admin']], function () {
                Route::delete('/xoa/{id}', 'delete')->name('delete');
            });
        });
    });


    //Select Search
    Route::prefix('/search')->as('search.')->group(function () {
        Route::prefix('/select')->as('select.')->group(function () {
            Route::get('/user', [App\Admin\Http\Controllers\User\UserSearchSelectController::class, 'selectSearch'])->name('user');
        });
    });

    //Contact
    Route::controller(App\Admin\Http\Controllers\Contact\ContactController::class)
        ->prefix('/contact')
        ->as('contact.')
        ->group(function () {
            // Route::group(['middleware' => ['permission:createContact', 'auth:admin']], function () {
            //     Route::get('/add', 'create')->name('create');
            //     Route::post('/add', 'store')->name('store');
            // });
            Route::group(['middleware' => ['permission:viewContact', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/edit/{id}', 'edit')->name('edit');
            });

            Route::group(['middleware' => ['permission:updateContact', 'auth:admin']], function () {
                Route::put('/edit', 'update')->name('update');
            });

            Route::group(['middleware' => ['permission:deleteContact', 'auth:admin']], function () {
                Route::delete('/delete/{id}', 'delete')->name('delete');
            });
        });

    //Address
    Route::get('/address/districts', [AddressController::class, 'getDistrictsByProvince'])->name('districts');
    Route::get('/address/wards', [AddressController::class, 'getWardsByDistrict'])->name('wards');

    //***** -- Module -- ******* //
    Route::prefix('/module')->as('module.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\Module\ModuleController::class)->group(function () {
            Route::get('/them', 'create')->name('create');
            Route::get('/', 'index')->name('index');
            Route::get('/summary', 'summary')->name('summary');
            Route::get('/sua/{id}', 'edit')->name('edit');
            Route::put('/sua', 'update')->name('update');
            Route::post('/them', 'store')->name('store');
            Route::delete('/xoa/{id}', 'delete')->name('delete');
        });
    });
    //***** -- Module -- ******* //

    //***** -- Permission -- ******* //
    Route::prefix('/permission')->as('permission.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\Permission\PermissionController::class)->group(function () {
            Route::get('/them', 'create')->name('create');
            Route::get('/', 'index')->name('index');
            Route::get('/sua/{id}', 'edit')->name('edit');
            Route::put('/sua', 'update')->name('update');
            Route::post('/them', 'store')->name('store');
            Route::delete('/xoa/{id}', 'delete')->name('delete');
        });
    });
    //***** -- Permission -- ******* //

    //***** -- Role -- ******* //
    Route::prefix('/role')->as('role.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\Role\RoleController::class)->group(function () {

            Route::group(['middleware' => ['permission:createRole', 'auth:admin']], function () {
                Route::get('/them', 'create')->name('create');
                Route::post('/them', 'store')->name('store');
            });
            Route::group(['middleware' => ['permission:viewRole', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/sua/{id}', 'edit')->name('edit');
            });

            Route::group(['middleware' => ['permission:updateRole', 'auth:admin']], function () {
                Route::put('/sua', 'update')->name('update');
            });

            Route::group(['middleware' => ['permission:deleteRole', 'auth:admin']], function () {
                Route::delete('/xoa/{id}', 'delete')->name('delete');
            });
        });
    });
    //***** -- Role -- ******* //


    //Post
    Route::prefix('/posts')->as('post.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\Post\PostController::class)->group(function () {

            Route::group(['middleware' => ['permission:createPost', 'auth:admin']], function () {
                Route::get('/them', 'create')->name('create');
                Route::post('/them', 'store')->name('store');
            });
            Route::group(['middleware' => ['permission:viewPost', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/sua/{id}', 'edit')->name('edit');
            });

            Route::group(['middleware' => ['permission:updatePost', 'auth:admin']], function () {
                Route::put('/sua', 'update')->name('update');
            });

            Route::group(['middleware' => ['permission:deletePost', 'auth:admin']], function () {
                Route::delete('/xoa/{id}', 'delete')->name('delete');
            });
        });
    });

    //Post
    Route::prefix('/products')->as('product.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\Product\ProductController::class)->group(function () {

            Route::group(['middleware' => ['permission:createProduct', 'auth:admin']], function () {
                Route::get('/them', 'create')->name('create');
                Route::post('/them', 'store')->name('store');
            });
            Route::group(['middleware' => ['permission:viewProduct', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/sua/{id}', 'edit')->name('edit');
            });

            Route::group(['middleware' => ['permission:updateProduct', 'auth:admin']], function () {
                Route::put('/sua', 'update')->name('update');
            });

            Route::group(['middleware' => ['permission:deleteProduct', 'auth:admin']], function () {
                Route::delete('/xoa/{id}', 'delete')->name('delete');
            });
        });
    });

    //Settings
    Route::controller(App\Admin\Http\Controllers\Setting\SettingController::class)
        ->prefix('/settings')
        ->as('setting.')
        ->group(function () {
            Route::group(['middleware' => ['permission:settingGeneral', 'auth:admin']], function () {
                Route::get('/general', 'general')->name('general');
            });
            Route::group(['middleware' => ['permission:settingCompany', 'auth:admin']], function () {
                Route::get('/company', 'company')->name('company');
            });

            Route::get('/user-shopping', 'userShopping')->name('user_shopping');
            Route::put('/update', 'update')->name('update');
        });

    //sliders
    Route::prefix('/sliders')->as('slider.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\Slider\SliderItemController::class)
            ->as('item.')
            ->group(function () {
                Route::get('/{slider_id}/item/them', 'create')->name('create');
                Route::get('/{slider_id}/item', 'index')->name('index');
                Route::get('/item/sua/{id}', 'edit')->name('edit');
                Route::put('/item/sua', 'update')->name('update');
                Route::post('/item/them', 'store')->name('store');
                Route::delete('/{slider_id}/item/xoa/{id}', 'delete')->name('delete');
            });
        Route::controller(App\Admin\Http\Controllers\Slider\SliderController::class)->group(function () {
            Route::group(['middleware' => ['permission:createSlider', 'auth:admin']], function () {
                Route::get('/them', 'create')->name('create');
                Route::post('/them', 'store')->name('store');
            });
            Route::group(['middleware' => ['permission:viewSlider', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/sua/{id}', 'edit')->name('edit');
            });

            Route::group(['middleware' => ['permission:updateSlider', 'auth:admin']], function () {
                Route::put('/sua', 'update')->name('update');
            });

            Route::group(['middleware' => ['permission:deleteSlider', 'auth:admin']], function () {
                Route::delete('/xoa/{id}', 'delete')->name('delete');
            });
        });
    });

    //user
    Route::prefix('/users')->as('user.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\User\UserController::class)->group(function () {
            Route::group(['middleware' => ['permission:createUser', 'auth:admin']], function () {
                Route::get('/them', 'create')->name('create');
                Route::post('/them', 'store')->name('store');
            });
            Route::group(['middleware' => ['permission:viewUser', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/sua/{id}', 'edit')->name('edit');
            });

            Route::group(['middleware' => ['permission:updateUser', 'auth:admin']], function () {
                Route::put('/sua', 'update')->name('update');
            });

            Route::group(['middleware' => ['permission:deleteUser', 'auth:admin']], function () {
                Route::delete('/xoa/{id}', 'delete')->name('delete');
            });
        });
        // Route::get('/select-search', [AdminSearchController::class, 'selectSearch'])->name('selectsearch');
    });
    //admin
    Route::prefix('/admins')->as('admin.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\Admin\AdminController::class)->group(function () {
            Route::group(['middleware' => ['permission:createAdmin', 'auth:admin']], function () {
                Route::get('/them', 'create')->name('create');
                Route::post('/them', 'store')->name('store');
            });
            Route::group(['middleware' => ['permission:viewAdmin', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/sua/{id}', 'edit')->name('edit');
            });

            Route::group(['middleware' => ['permission:updateAdmin', 'auth:admin']], function () {
                Route::put('/sua', 'update')->name('update');
            });

            Route::group(['middleware' => ['permission:deleteAdmin', 'auth:admin']], function () {
                Route::delete('/xoa/{id}', 'delete')->name('delete');
            });
        });
        // Route::get('/select-search', [AdminSearchController::class, 'selectSearch'])->name('selectsearch');
    });

    //ckfinder
    Route::prefix('/quan-ly-file')->as('ckfinder.')->group(function () {
        Route::any('/ket-noi', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
            ->name('connector');
        Route::any('/duyet', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
            ->name('browser');
    });
    Route::get('/dashboard', [App\Admin\Http\Controllers\Dashboard\DashboardController::class, 'index'])->name('dashboard');

    //auth
    Route::controller(App\Admin\Http\Controllers\Auth\ProfileController::class)
        ->prefix('/profile')
        ->as('profile.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::put('/', 'update')->name('update');
        });

    Route::controller(App\Admin\Http\Controllers\Auth\ChangePasswordController::class)
        ->prefix('/password')
        ->as('password.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::put('/', 'update')->name('update');
        });
    Route::prefix('/search')->as('search.')->group(function () {
        Route::prefix('/select')->as('select.')->group(function () {
            Route::get('/user', [App\Admin\Http\Controllers\User\UserSearchSelectController::class, 'selectSearch'])->name('user');
            Route::get('/school', [App\Admin\Http\Controllers\School\SchoolSearchSelectController::class, 'selectSearch'])->name('school');
            Route::get('/province', [App\Admin\Http\Controllers\Address\Address\Province\ProvinceSearchController::class, 'selectSearch'])->name('province');
            Route::get('/district', [App\Admin\Http\Controllers\Address\Address\District\DistrictSearchController::class, 'selectDistrict'])->name('district');
            Route::get('/ward', [App\Admin\Http\Controllers\Address\Address\Ward\WardSearchController::class, 'selectSearch'])->name('ward');
        });
    });
    // Import file Truong hoc
    Route::post('/import', [App\Admin\Http\Controllers\School\SchoolController::class, 'import'])->name('import');

    Route::post('/logout', [App\Admin\Http\Controllers\Auth\LogoutController::class, 'logout'])->name('logout');
});
