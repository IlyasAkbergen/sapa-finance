<?php

namespace App\Providers;

use App\Models\Purchase;
use App\Models\User;
use App\Observers\PurchaseObserver;
use App\Observers\UserObserver;
use App\Services\BalanceService;
use App\Services\BalanceServiceImpl;
use App\Services\BaseService;
use App\Services\BaseServiceImpl;
use App\Services\UserService;
use App\Services\UserServiceImpl;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BaseService::class, BaseServiceImpl::class);
        $this->app->bind(UserService::class, UserServiceImpl::class);
        $this->app->bind(
            BalanceService::class,
            BalanceServiceImpl::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Purchase::observe(PurchaseObserver::class);
    }
}
