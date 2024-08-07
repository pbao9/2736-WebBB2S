<?php

namespace App\Admin\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected array $repositories = [
        'App\Admin\Repositories\Module\ModuleRepositoryInterface' => 'App\Admin\Repositories\Module\ModuleRepository',
        'App\Admin\Repositories\Permission\PermissionRepositoryInterface' => 'App\Admin\Repositories\Permission\PermissionRepository',
        'App\Admin\Repositories\Role\RoleRepositoryInterface' => 'App\Admin\Repositories\Role\RoleRepository',
        'App\Admin\Repositories\Admin\AdminRepositoryInterface' => 'App\Admin\Repositories\Admin\AdminRepository',
        'App\Admin\Repositories\User\UserRepositoryInterface' => 'App\Admin\Repositories\User\UserRepository',
        'App\Admin\Repositories\Category\CategoryRepositoryInterface' => 'App\Admin\Repositories\Category\CategoryRepository',
        'App\Admin\Repositories\Slider\SliderRepositoryInterface' => 'App\Admin\Repositories\Slider\SliderRepository',
        'App\Admin\Repositories\Slider\SliderItemRepositoryInterface' => 'App\Admin\Repositories\Slider\SliderItemRepository',
        'App\Admin\Repositories\Setting\SettingRepositoryInterface' => 'App\Admin\Repositories\Setting\SettingRepository',
        'App\Admin\Repositories\Post\PostRepositoryInterface' => 'App\Admin\Repositories\Post\PostRepository',
        'App\Admin\Repositories\PostCategory\PostCategoryRepositoryInterface' => 'App\Admin\Repositories\PostCategory\PostCategoryRepository',
        'App\Admin\Repositories\Notification\NotificationRepositoryInterface' => 'App\Admin\Repositories\Notification\NotificationRepository',
        'App\Admin\Repositories\Contact\ContactRepositoryInterface' => 'App\Admin\Repositories\Contact\ContactRepository',
        'App\Admin\Repositories\Province\ProvinceRepositoryInterface' => 'App\Admin\Repositories\Province\ProvinceRepository',
        'App\Admin\Repositories\District\DistrictRepositoryInterface' => 'App\Admin\Repositories\District\DistrictRepository',
        'App\Admin\Repositories\Ward\WardRepositoryInterface' => 'App\Admin\Repositories\Ward\WardRepository',
        'App\Admin\Repositories\SchoolStudent\SchoolStudentRepositoryInterface' => 'App\Admin\Repositories\SchoolStudent\SchoolStudentRepository',
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        //
        foreach ($this->repositories as $interface => $implement) {
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
