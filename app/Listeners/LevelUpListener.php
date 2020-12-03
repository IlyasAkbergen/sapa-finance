<?php

namespace App\Listeners;

use App\Enums\ReferralLevelEnum;
use App\Events\RewardHandled;
use App\Models\ReferralLevel;
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
        $event->reward->loadMissing(['awardable.balance.incomes']);
        $user = $event->reward->awardable;

        if ($user->referral_level_id == ReferralLevelEnum::Partner) {
            return;
        }

        $next_level_id = empty($user->referral_level_id)
            ? ReferralLevelEnum::Agent
            : $user->referral_level_id + 1;

        $next_level = ReferralLevel::findOrFail($next_level_id);

        $deservesLevelUp = true;

        foreach ($next_level->achieve_challenges as $challenge) {
            $deservesLevelUp = $deservesLevelUp && $challenge::check($user);
        }

        if ($deservesLevelUp) {
            $user->updateReferralLevel($next_level_id);
        }
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
