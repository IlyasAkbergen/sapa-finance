<?php

namespace App\Listeners;

use App\Events\BalanceUpdated;
use App\Events\PurchaseMade;
use Illuminate\Events\Dispatcher;

class ReferralEventsSubscriber
{
    public function handlePurchaseMade($event) {
        $purchase = $event->purchase;
        $purchase->load(['user', 'purchasable']);


    }

    public function handleBalanceUpdated($event) {

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
    }
}
