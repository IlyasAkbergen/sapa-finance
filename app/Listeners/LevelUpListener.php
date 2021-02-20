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
        $reward = data_get($event, 'reward');

        if (!$reward) {
            return;
        }

        $reward->load(['awardable']);

        $user = data_get($reward, 'awardable');

        $points = data_get($reward, 'points');

        $user->messages()->create([
            'title' => 'Получены бонусы',
            'content' => "Вы получили бонус\n" .
                "Комиссионные: " . data_get($reward, 'sum') .
                "Единицы: " . (data_get($reward, 'is_direct') ? $points : 0) .
                "Командные единицы: " . !(data_get($reward, 'is_direct') ? $points : 0),
            'url' => null,
            'is_public' => false
        ]);

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
