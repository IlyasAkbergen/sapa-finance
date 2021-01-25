<?php

namespace App\Providers;

use App\Http\Resources\AuthUserResource;
use App\Models\Message;
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
use App\Services\Gates\PayboxGate;
use App\Services\Gates\PaymentGateContract;
use App\Services\HomeworkService;
use App\Services\HomeworkServiceImpl;
use App\Services\LessonService;
use App\Services\LessonServiceImpl;
use App\Services\MessageService;
use App\Services\MessageServiceImpl;
use App\Services\PartnerService;
use App\Services\PartnerServiceContract;
use App\Services\PaymentService;
use App\Services\PaymentServiceContract;
use App\Services\PayoutService;
use App\Services\PayoutServiceContract;
use App\Services\PurchaseService;
use App\Services\PurchaseServiceContract;
use App\Services\UserService;
use App\Services\UserServiceImpl;
use App\Services\SupportService;
use App\Services\SupportServiceImpl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            MessageService::class,
            MessageServiceImpl::class
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
        $this->app->bind(
            PurchaseServiceContract::class,
            PurchaseService::class
        );
        $this->app->bind(
            PaymentGateContract::class,
            PayboxGate::class
        );
        $this->app->bind(
            PaymentServiceContract::class,
            PaymentService::class
        );
        $this->app->bind(
            PayoutServiceContract::class,
            PayoutService::class
        );
        $this->app->bind(
            AttachmentService::class,
            AttachmentServiceImpl::class
        );
        $this->app->bind(
            PartnerServiceContract::class,
            PartnerService::class
        );
        $this->app->bind(
            SupportService::class,
            SupportServiceImpl::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Inertia::share([
            'notifications' => function () {
                Auth::user()->load('newMessages');
                return Auth::check() ? Auth::user()->newMessages : [];
            },
            'referral_link' => function () {
                return Auth::check() ? Auth::user()->referral_link : null;
            },
        ]);

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
                'sub_message' => Session::get('sub_message'),
            ];
        });

    }
}
