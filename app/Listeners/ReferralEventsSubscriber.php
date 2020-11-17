<?php

namespace App\Listeners;

use App\Events\BalanceUpdated;
use App\Events\PurchaseMade;
use App\Models\Balance;
use App\Models\BalanceOperation;
use App\Models\Purchase;
use Illuminate\Auth\Events\Registered;
use Illuminate\Events\Dispatcher;

class ReferralEventsSubscriber
{
    public function handlePurchaseMade($event) {
        $purchase = $event->purchase;
        $purchase->load(['user.referrer.balance', 'purchasable.awardable']);

        if (empty($purchase->user->referrer)) {
            return;
        }

        $purchasable = $purchase->purchasable;

        $operation = new BalanceOperation();
        $operation->target_balance_id = $purchase->user->referrer->balance_id;
        $operation->sum = $purchasable->awardable->getAwardSum();
        $operation->purchase_id = $purchase->id;

        if ($purchasable->awardable->isAwardable()) {
            $operation->direct_points = Purchase::$DIRECT_POINTS_PER_PURCHASE;
        }

        $operation->save();
    }

    public function handleBalanceUpdated($event) {
        // TODO realize
        // нужно для пересчета процентов в верхней части пирамиды
    }

    public function handleUserRegistered($event) {
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
            BalanceUpdated::class,
            [self::class, 'handleBalanceUpdated']
        );

        $events->listen(
            Registered::class,
            [self::class, 'handleUserRegistered']
        );
    }
}
