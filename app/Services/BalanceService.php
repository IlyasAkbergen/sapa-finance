<?php


namespace App\Services;


use App\Models\Reward;

interface BalanceService
{
    /**
     * @param Reward $reward
    */
    public function createOperationForReward(Reward $reward);
}