<?php

namespace App\Providers;
use App\Admin\Repositories\ContractDetail\ContractDetailRepository;
use App\Admin\Repositories\ContractDetail\ContractDetailRepositoryInterface;
use App\Admin\Repositories\Nany\NanyRepository;
use App\Admin\Repositories\Nany\NanyRepositoryInterface;
use App\Admin\Repositories\Notification\NotificationRepository;
use App\Admin\Repositories\Notification\NotificationRepositoryInterface;
use App\Admin\Repositories\Parent\ParentRepository;
use App\Admin\Repositories\Parent\ParentRepositoryInterface;
use App\Admin\Repositories\School\SchoolRepository;
use App\Admin\Repositories\School\SchoolRepositoryInterface;
use App\Admin\Repositories\Student\StudentRepository;
use App\Admin\Repositories\Student\StudentRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        'App\Repositories\User\UserRepositoryInterface' => 'App\Repositories\User\UserRepository',
        'App\Repositories\Setting\SettingRepositoryInterface' => 'App\Repositories\Setting\SettingRepository',
        'App\Repositories\Parent\ParentRepositoryInterface' => 'App\Repositories\Parent\ParentRepository',
        'App\Repositories\Contract\ContractRepositoryInterface' => 'App\Repositories\Contract\ContractRepository',
        'App\Repositories\Contact\ContactRepositoryInterface' => 'App\Repositories\Contact\ContactRepository',
        'App\Repositories\Province\ProvinceRepositoryInterface' => 'App\Repositories\Province\ProvinceRepository',
        'App\Repositories\District\DistrictRepositoryInterface' => 'App\Repositories\District\DistrictRepository',
        'App\Repositories\Ward\WardRepositoryInterface' => 'App\Repositories\Ward\WardRepository',
        'App\Repositories\Slider\SliderRepositoryInterface' => 'App\Repositories\Slider\SliderRepository',
        'App\Repositories\Slider\SliderItemRepositoryInterface' => 'App\Repositories\Slider\SliderItemRepository',
        'App\Repositories\Product\ProductRepositoryInterface' => 'App\Repositories\Product\ProductRepository',
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        foreach ($this->repositories as $interface => $implement) {
            $this->app->singleton($interface, $implement);
        }
        $this->app->bind(SchoolRepositoryInterface::class, SchoolRepository::class);
        $this->app->bind(NotificationRepositoryInterface::class, NotificationRepository::class);
        $this->app->bind(SchoolRepositoryInterface::class, SchoolRepository::class);
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
