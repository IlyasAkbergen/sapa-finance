<?php

namespace App\Listeners;

use App\Events\BalanceOperationCreated;

class BalanceEventsSubscriber
{
    public function handleBalanceOperationCreated($event)
    {
        // todo apply operation
    }

    public function subscribe($events)
    {
        $events->listen(
            BalanceOperationCreated::class,
            [self::class, 'handleBalanceOperationCreated']
        );
    }
}
