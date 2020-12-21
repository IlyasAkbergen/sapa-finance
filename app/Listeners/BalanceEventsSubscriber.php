<?php

namespace App\Listeners;

use App\Events\BalanceOperationCreated;
use App\Events\PayoutCommitted;
use App\Events\PayoutCreated;
use App\Models\Balance;
use App\Services\BalanceOperationService;
use App\Services\Gates\PaymentGateContract;
use Illuminate\Contracts\Queue\ShouldQueue;

class BalanceEventsSubscriber implements ShouldQueue
{
    private $paymentGate;
    private $operationService;

    public function __construct(
        PaymentGateContract $paymentGate,
        BalanceOperationService $operationService
    )
    {
        $this->paymentGate = $paymentGate;
        $this->operationService = $operationService;
    }

    public function handleBalanceOperationCreated($event)
    {
        $operation = $event->operation;

        if ($operation->committed) {
            return;
        }

        $source_balance = empty($operation->source_balance_id)
            ? null : Balance::find($operation->source_balance_id);
        $target_balance = empty($operation->target_balance_id)
            ? null : Balance::find($operation->target_balance_id);

        // todo подумать над всей этой копипастой

        if (!empty($operation->sum)) {
            if (!empty($source_balance)) {
                $source_balance->sum -= $operation->sum;
            }

            if (!empty($target_balance)) {
                $target_balance->sum += $operation->sum;
            }
        }

        if (!empty($operation->direct_points)) {
            if (!empty($source_balance)) {
                $source_balance->direct_points -= $operation->direct_points;
            }

            if (!empty($target_balance)) {
                $target_balance->direct_points += $operation->direct_points;
            }
        }

        if (!empty($operation->team_points)) {
            if (!empty($source_balance)) {
                $source_balance->team_points -= $operation->team_points;
            }

            if (!empty($target_balance)) {
                $target_balance->team_points += $operation->team_points;
            }
        }

        if (!empty($source_balance)) {
            $source_balance->save();
        }

        if (!empty($target_balance)) {
            $target_balance->save();
        }

        $operation->update([
            'committed' => true
        ]);
    }

    public function handlePayoutCommitted($event)
    {
        $payout = $event->payout;

        $payout->loadMissing('user');

        $this->operationService->create([
            'source_balance_id' => $payout->user->balance_id,
            'sum' => $payout->sum,
            'payout_id' => $payout->id
        ]);
    }

    public function subscribe($events)
    {
        $events->listen(
            BalanceOperationCreated::class,
            [self::class, 'handleBalanceOperationCreated'],
            PayoutCommitted::class,
            [self::class, 'handlePayoutCommitted']
        );
    }
}
