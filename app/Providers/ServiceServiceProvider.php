<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    protected $services = [
        'App\Services\Auth\AuthServiceInterface' => 'App\Services\Auth\AuthService',
        'App\Admin\Services\Parent\ParentServiceInterface' => 'App\Admin\Services\Parent\ParentService',
        'App\Admin\Services\Contract\ContractServiceInterface' => 'App\Admin\Services\Contract\ContractService',
        'App\Admin\Services\ContractDetail\ContractDetailServiceInterface' => 'App\Admin\Services\ContractDetail\ContractDetailService',
        'App\Admin\Services\Notification\NotificationServiceInterface' => 'App\Admin\Services\Notification\NotificationService',
        'App\Admin\Services\Student\StudentServiceInterface' => 'App\Admin\Services\Student\StudentService',
        'App\Api\V1\Services\Student\StudentServiceInterface' => 'App\Api\V1\Services\Student\StudentService',
        'App\Services\Contact\ContactServiceInterface' => 'App\Services\Contact\ContactService',
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
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
