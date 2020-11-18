<?php

namespace App\Listeners;

use App\Events\BalanceUpdated;
use App\Events\PurchaseMade;
use App\Events\RewardCreated;
use App\Helpers\Helper;
use App\Models\Balance;
use App\Models\BalanceOperation;
use App\Models\Purchase;
use App\Models\Reward;
use Illuminate\Auth\Events\Registered;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\DB;

class ReferralEventsSubscriber
{
    public function handlePurchaseMade($event) {

        DB::beginTransaction();

        try {
            $purchase = $event->purchase;
            $purchase->load(['user.referrer_recursive', 'purchasable']);

            if (empty($purchase->user->referrer)) {
                return;
            }

            $purchasable = $purchase->purchasable;

            $all_referrers = Helper::flat_all_referrers($purchase->user);

            foreach ($all_referrers as $referrer) {
                Reward::updateOrCreate([
                    'target_user_id' => $referrer->id,
                    'purchase_id' => $purchase->id,
                ],[
                    'sum' => $purchasable->getAwardSum(),
                    'is_direct' => $purchase->user->referrer_id == $referrer->id,
                    'points' => $purchasable->isAwardable()
                        ? Purchase::$DIRECT_POINTS_PER_PURCHASE
                        : null
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    public function handleRewardCreated($event) {
        $reward = $event->reward;

        if ($reward->handled) return;

        DB::beginTransaction();

        try {

            $reward->load(['awardable']);

            if (empty($reward->awardable->balance_id)) {
                $reward->awardable->update([
                    'balance_id' => Balance::create()->id
                ]);
            }

            $operation = new BalanceOperation();
            $operation->target_balance_id = $reward->awardable->balance_id;
            $operation->sum = $reward->sum;
            $operation->purchase_id = $reward->purchase_id;
            $operation->reward_id = $reward->id;

            if (!empty($reward->points)) {
                if ($reward->is_direct) {
                    $operation->direct_points = $reward->points;
                } else {
                    $operation->team_points = $reward->points;
                }
            }

            $operation->save();
            $reward->update([
                'handled' => true
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
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
            RewardCreated::class,
            [self::class, 'handleRewardCreated']
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
