<?php

namespace App\Listeners;

use App\Events\BalanceOperationCreated;
use App\Models\Balance;
use Illuminate\Contracts\Queue\ShouldQueue;

class BalanceEventsSubscriber implements ShouldQueue
{
    public function handleBalanceOperationCreated($event)
    {
        $operation = $event->operation;

        if ($operation->committed) {
            return;
        }

        $target_balance = Balance::findOrFail($operation->target_balance_id);

        if (!empty($operation->sum)) {
            $target_balance->sum += $operation->sum;
            // TODO craete incomes
        }

        if (!empty($operation->direct_points)) {
            $target_balance->direct_points += $operation->direct_points;
        }

        if (!empty($operation->team_points)) {
            $target_balance->team_points += $operation->team_points;
        }

        $target_balance->save();

        $operation->update([
            'committed' => true
        ]);
    }

    public function subscribe($events)
    {
        $events->listen(
            BalanceOperationCreated::class,
            [self::class, 'handleBalanceOperationCreated']
        );
    }
}
