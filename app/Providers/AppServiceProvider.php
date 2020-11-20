<?php

namespace App\Providers;

use App\Models\Purchase;
use App\Models\User;
use App\Observers\PurchaseObserver;
use App\Observers\UserObserver;
use App\Services\BalanceOperationService;
use App\Services\BalanceOperationServiceImpl;
use App\Services\BaseService;
use App\Services\BaseServiceImpl;
use App\Services\NotificationService;
use App\Services\NotificationServiceImpl;
use App\Services\UserService;
use App\Services\UserServiceImpl;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

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
            BalanceOperationService::class,
            BalanceOperationServiceImpl::class
        );
        $this->app->bind(
            NotificationService::class,
            NotificationServiceImpl::class
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

        // todo practice tutorial from here: https://www.itsolutionstuff.com/post/laravel-8-inertia-js-crud-with-jetstream-tailwind-cssexample.html
        Inertia::share([
            'errors' => function () {
                return Session::get('errors')
                    ? Session::get('errors')->getBag('default')->getMessages()
                    : (object) [];
            },
        ]);

        Inertia::share('flash', function () {
            return [
                'message' => Session::get('message'),
            ];
        });
    }
}
