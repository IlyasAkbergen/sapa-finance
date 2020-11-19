<?php


namespace App\Services;


use App\Models\Balance;
use App\Models\BalanceOperation;
use App\Models\Reward;

class BalanceOperationServiceImpl extends BaseServiceImpl implements BalanceOperationService
{
    public function __construct(BalanceOperation $model)
    {
        parent::__construct($model);
    }

    /**
     * @inheritDoc
     */
    public function createOperationForReward(Reward $reward)
    {
        $reward->loadMissing(['awardable']);

        if (empty($reward->awardable->balance_id)) {
            echo "empty balance id: " . $reward->awardable->id . "\n";
            $reward->awardable->update([
                'balance_id' => Balance::create()->id
            ]);
        }

        $operation_data = [
            'target_balance_id' => $reward->awardable->balance_id,
            'sum' => $reward->sum,
            'purchase_id' => $reward->purchase_id,
            'reward_id' => $reward->id,
        ];

        if (!empty($reward->points)) {
            if ($reward->is_direct) {
                $operation_data['direct_points'] = $reward->points;
            } else {
                $operation_data['team_points'] = $reward->points;
            }
        }

        return $this->create($operation_data);
    }
}