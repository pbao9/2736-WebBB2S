<?php

namespace App\Api\V1\Providers;

use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    protected array $services = [
        'App\Api\V1\Services\User\UserServiceInterface' => 'App\Api\V1\Services\User\UserService',
        'App\Api\V1\Services\Auth\AuthServiceInterface' => 'App\Api\V1\Services\Auth\AuthService',
        'App\Api\V1\Services\Notification\NotificationServiceInterface' => 'App\Api\V1\Services\Notification\NotificationService',
        'App\Api\V1\Services\Trip\TripServiceInterface' => 'App\Api\V1\Services\Trip\TripService',
        'App\Api\V1\Services\TripDetail\TripDetailServiceInterface' => 'App\Api\V1\Services\TripDetail\TripDetailService',
        'App\Api\V1\Services\ScheduleOff\ScheduleOffServiceInterface' => 'App\Api\V1\Services\ScheduleOff\ScheduleOffService',
        'App\Api\V1\Services\Parent\ParentServiceInterface' => 'App\Api\V1\Services\Parent\ParentService',
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
