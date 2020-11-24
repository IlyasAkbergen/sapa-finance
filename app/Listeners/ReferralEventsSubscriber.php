<?php

namespace App\Listeners;

use App\Events\PurchaseMade;
use App\Events\RewardCreated;
use App\Models\Balance;
use App\Services\BalanceOperationService;
use App\Services\UserService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\DB;

class ReferralEventsSubscriber implements ShouldQueue
{
    private $userService;
    private $balanceService;

    public function __construct(
        UserService $userService,
        BalanceOperationService $balanceService
    ) {
        $this->userService = $userService;
        $this->balanceService = $balanceService;
    }

    public function handlePurchaseMade($event)
    {
        $purchase = $event->purchase;
        $this->userService->awardReferrersAfterPurchase($purchase);
    }

    public function handleRewardCreated($event)
    {
        $reward = $event->reward;

        if ($reward->handled) return;

        DB::beginTransaction();

        try {

            $operation = $this->balanceService->createOperationForReward($reward);

            if (!empty($operation)) {
                $reward->update([
                    'handled' => true
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
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
            PurchaseMade::class,
            [self::class, 'handlePurchaseMade']
        );

        $events->listen(
            RewardCreated::class,
            [self::class, 'handleRewardCreated']
        );

        $events->listen(
            Registered::class,
            [self::class, 'handleUserRegistered']
        );
    }
}