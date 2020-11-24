<?php

namespace App\Providers;

use App\Models\Purchase;
use App\Models\User;
use App\Observers\PurchaseObserver;
use App\Observers\UserObserver;
use App\Services\ArticlesService;
use App\Services\ArticlesServiceImpl;
use App\Services\AttachmentService;
use App\Services\AttachmentServiceImpl;
use App\Services\BalanceOperationService;
use App\Services\BalanceOperationServiceImpl;
use App\Services\BaseService;
use App\Services\BaseServiceImpl;
use App\Services\BriefcaseService;
use App\Services\BriefcaseServiceImpl;
use App\Services\CourseService;
use App\Services\CourseServiceImpl;
use App\Services\HomeworkService;
use App\Services\HomeworkServiceImpl;
use App\Services\LessonService;
use App\Services\LessonServiceImpl;
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
        $this->app->bind(
            ArticlesService::class,
            ArticlesServiceImpl::class
        );
        $this->app->bind(
            BriefcaseService::class,
            BriefcaseServiceImpl::class
        );
        $this->app->bind(
            CourseService::class,
            CourseServiceImpl::class
        );
        $this->app->bind(
            LessonService::class,
            LessonServiceImpl::class
        );
        $this->app->bind(
            HomeworkService::class,
            HomeworkServiceImpl::class
        );
        $this->app->bind(
            AttachmentService::class,
            AttachmentServiceImpl::class
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
