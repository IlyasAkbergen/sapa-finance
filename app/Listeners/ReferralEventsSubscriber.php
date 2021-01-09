<?php

namespace App\Listeners;

use App\Enums\ReferralLevelEnum;
use App\Events\PurchasePayed;
use App\Events\RewardCreated;
use App\Models\Balance;
use App\Models\Course;
use App\Models\User;
use App\Services\BalanceOperationService;
use App\Services\PurchaseServiceContract;
use App\Services\UserService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\DB;

class ReferralEventsSubscriber implements ShouldQueue
{
    private $userService;
    private $balanceService;
    private $purchaseService;

    public function __construct(
        UserService $userService,
        BalanceOperationService $balanceService,
        PurchaseServiceContract $purchaseService
    ) {
        $this->userService = $userService;
        $this->balanceService = $balanceService;
        $this->purchaseService = $purchaseService;
    }

    public function handlePurchasePaid($event)
    {
        $purchase = $event->purchase;
        $purchase->loadMissing(['purchasable', 'user']);
        $purchasable = $purchase->purchasable;
        $this->purchaseService->addUsersToPurchasable(
            [$purchase->user_id], $purchasable, $purchase->user->referrer_id
                ?: User::where(
                    'referral_level_id',
                    ReferralLevelEnum::Consultant
                )
                ->first()->id,
            $purchase
        );
        $this->userService->awardReferrersAfterPurchase($purchase);

        if ($purchasable instanceof Course
            && $purchasable->tag == Course::START_COURSE_TAG) {
            $this->userService->tryNextLevel($purchase->user);
        }
    }

    public function handleUserRegistered($event)
    {
        $user = $event->user;
        $user->load(['referrer']);

        $balance = Balance::create([
            'sum' => 0,
            'direct_points' => 0,
            'team_points' => 0,
        ]);

        $user->balance_id = $balance->id;

        if (!empty($user->referrer)) {
            $user->root_referrer_id = $user->referrer->root_referrer_id != null
                ? $user->referrer->root_referrer_id
                : $user->referrer->id;
        }

        $user->save();
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
            PurchasePayed::class,
            [self::class, 'handlePurchasePaid']
        );

        $events->listen(
            Registered::class,
            [self::class, 'handleUserRegistered']
        );
    }
}
