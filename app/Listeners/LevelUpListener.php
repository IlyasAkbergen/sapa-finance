<?php

namespace App\Listeners;

use App\Events\RewardHandled;
use App\Services\UserService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Events\Dispatcher;

class LevelUpListener implements ShouldQueue
{
    private $userService;

    /**
     * Create the event listener.
     *
     * @param UserService $userService
     */
    public function __construct(
        UserService $userService
    )
    {
        $this->userService = $userService;
    }

    /**
     * Checks if user achieved new level and updates if true
    */
    public function handleRewardHandled($event)
    {
        // may be errors todo test
        if (!$event->reward->relationLoaded('awardable')) {
            $event->reward->load(['awardable.balance.incomes']);
        }

        $user = $event->reward->awardable;

        $this->userService->tryNextLevel($user);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Dispatcher  $events
     * @return void
     */
    public function subscribe($events)
    {
        $events->listen(
            RewardHandled::class,
            [self::class, 'handleRewardHandled']
        );
    }
}
