<?php

namespace App\Api\V1\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected array $repositories = [
        'App\Api\V1\Repositories\User\UserRepositoryInterface' => 'App\Api\V1\Repositories\User\UserRepository',
        'App\Api\V1\Repositories\Slider\SliderRepositoryInterface' => 'App\Api\V1\Repositories\Slider\SliderRepository',
        'App\Api\V1\Repositories\Slider\SliderItemRepositoryInterface' => 'App\Api\V1\Repositories\Slider\SliderItemRepository',
        'App\Api\V1\Repositories\Post\PostRepositoryInterface' => 'App\Api\V1\Repositories\Post\PostRepository',
        'App\Api\V1\Repositories\PostCategory\PostCategoryRepositoryInterface' => 'App\Api\V1\Repositories\PostCategory\PostCategoryRepository',
        'App\Api\V1\Repositories\Contract\ContractRepositoryInterface' => 'App\Api\V1\Repositories\Contract\ContractRepository',
        'App\Api\V1\Repositories\Notification\NotificationRepositoryInterface' => 'App\Api\V1\Repositories\Notification\NotificationRepository',
        'App\Api\V1\Repositories\Student\StudentRepositoryInterface' => 'App\Api\V1\Repositories\Student\StudentRepository',
        'App\Api\V1\Repositories\Trip\TripRepositoryInterface' => 'App\Api\V1\Repositories\Trip\TripRepository',
        'App\Api\V1\Repositories\TripDetail\TripDetailRepositoryInterface' => 'App\Api\V1\Repositories\TripDetail\TripDetailRepository',
        'App\Api\V1\Repositories\Nany\NanyRepositoryInterface' => 'App\Api\V1\Repositories\Nany\NanyRepository',
        'App\Api\V1\Repositories\Driver\DriverRepositoryInterface' => 'App\Api\V1\Repositories\Driver\DriverRepository',
        'App\Api\V1\Repositories\ScheduleOff\ScheduleOffRepositoryInterface' => 'App\Api\V1\Repositories\ScheduleOff\ScheduleOffRepository',
        'App\Api\V1\Repositories\Parent\ParentRepositoryInterface' => 'App\Api\V1\Repositories\Parent\ParentRepository',

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
