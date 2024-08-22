<?php

namespace App\Admin\Providers;

use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    protected array $services = [
		'App\Admin\Services\Module\ModuleServiceInterface' => 'App\Admin\Services\Module\ModuleService',
		'App\Admin\Services\Permission\PermissionServiceInterface' => 'App\Admin\Services\Permission\PermissionService',
		'App\Admin\Services\Role\RoleServiceInterface' => 'App\Admin\Services\Role\RoleService',
        'App\Admin\Services\Admin\AdminServiceInterface' => 'App\Admin\Services\Admin\AdminService',
        'App\Admin\Services\User\UserServiceInterface' => 'App\Admin\Services\User\UserService',
        'App\Admin\Services\Category\CategoryServiceInterface' => 'App\Admin\Services\Category\CategoryService',
        'App\Admin\Services\Product\ProductServiceInterface' => 'App\Admin\Services\Product\ProductService',
        'App\Admin\Services\Attribute\AttributeServiceInterface' => 'App\Admin\Services\Attribute\AttributeService',
        'App\Admin\Services\AttributeVariation\AttributeVariationServiceInterface' => 'App\Admin\Services\AttributeVariation\AttributeVariationService',
        'App\Admin\Services\Order\OrderServiceInterface' => 'App\Admin\Services\Order\OrderService',
        'App\Admin\Services\Slider\SliderServiceInterface' => 'App\Admin\Services\Slider\SliderService',
        'App\Admin\Services\Slider\SliderItemServiceInterface' => 'App\Admin\Services\Slider\SliderItemService',
        'App\Admin\Services\Post\PostServiceInterface' => 'App\Admin\Services\Post\PostService',
        'App\Admin\Services\PostCategory\PostCategoryServiceInterface' => 'App\Admin\Services\PostCategory\PostCategoryService',
        'App\Admin\Services\Notification\NotificationServiceInterface' => 'App\Admin\Services\Notification\NotificationService',
        'App\Admin\Services\School\SchoolServiceInterface' => 'App\Admin\Services\School\SchoolService',
        'App\Admin\Services\Contact\ContactServiceInterface' => 'App\Admin\Services\Contact\ContactService',
        'App\Admin\Services\Provice\ProvinceServiceInterface' => 'App\Admin\Services\Province\ProvinceService',
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        //
        foreach ($this->services as $interface => $implement) {
            $this->app->singleton($interface, $implement);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
