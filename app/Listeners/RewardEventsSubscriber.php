<?php

namespace App\Listeners;

use App\Events\RewardCreated;
use App\Services\BalanceOperationService;
use App\Services\PurchaseServiceContract;
use App\Services\UserService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\DB;

class RewardEventsSubscriber implements ShouldQueue
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

    public function handleRewardCreated($event)
    {
        $reward = $event->reward;

        if ($reward->handled) return;

        DB::beginTransaction();

        try {

            $operation = $this->balanceService->createOperationForReward($reward);

            if (!empty($operation)) {
                $reward->makeHandled();
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
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
            RewardCreated::class,
            [self::class, 'handleRewardCreated']
        );
    }
}
