<?php


namespace App\Services;


use App\Models\Balance;
use App\Models\BalanceOperation;
use App\Models\Reward;

class BalanceServiceImpl extends BaseServiceImpl implements BalanceService
{
    public function __construct(Balance $model)
    {
        parent::__construct($model);
    }

    /**
     * @inheritDoc
     */
    public function createOperationForReward(Reward $reward)
    {
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

        return $operation->save();
    }
}