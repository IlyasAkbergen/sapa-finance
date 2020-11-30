<?php

namespace App\Listeners;

use App\Events\BalanceOperationCreated;
use App\Events\PayoutCreated;
use App\Models\Balance;
use App\Services\Gates\PaymentGateContract;
use Illuminate\Contracts\Queue\ShouldQueue;

class BalanceEventsSubscriber implements ShouldQueue
{
    private $paymentGate;

    public function __construct(PaymentGateContract $paymentGate)
    {
        $this->paymentGate = $paymentGate;
    }

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

    public function handlePayoutCreated($event)
    {

    }

    public function subscribe($events)
    {
        $events->listen(
            BalanceOperationCreated::class,
            [self::class, 'handleBalanceOperationCreated'],
            PayoutCreated::class,
            [self::class, 'handlePayoutCreated']
        );
    }
}
