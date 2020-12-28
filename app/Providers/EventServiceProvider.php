<?php

namespace App\Providers;

use App\Listeners\BalanceEventsSubscriber;
use App\Listeners\CourseEventsSubscriber;
use App\Listeners\LevelUpListener;
use App\Listeners\ReferralEventsSubscriber;
use App\Listeners\RewardEventsSubscriber;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    protected $subscribe = [
        ReferralEventsSubscriber::class,
        BalanceEventsSubscriber::class,
        LevelUpListener::class,
        CourseEventsSubscriber::class,
        RewardEventsSubscriber::class
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
