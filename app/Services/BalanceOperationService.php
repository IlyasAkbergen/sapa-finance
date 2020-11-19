<?php


namespace App\Services;


use App\Models\Reward;

interface BalanceOperationService
{
    /**
     * @param Reward $reward
    */
    public function createOperationForReward(Reward $reward);
}