<?php


namespace App\Services;


use App\Models\Payout;
use App\Models\Purchase;
use App\Models\Reward;
use App\Models\User;

interface UserService
{
    /**
     * @param int $id user_id
     * @param array $reward_attributes
     * @return Reward
     */
    public function addReward($id, array $reward_attributes);

    /**
     * @param int $id user_id
     * @param array $payout_attributes
     * @return Payout | null
     */
    public function addPayout($id, array $payout_attributes);

    /**
     * @param int $id user_id
     * @param array $params
     * @param array $reward_attributes
     * @return Reward
     */
    public function updateOrAddReward($id, array $params, array $reward_attributes);

    /**
     * @param Purchase $purchase
     */
    public function awardReferrersAfterPurchase(Purchase $purchase);

    /**
     * @param $user_id
     */
    public function allReferralsOf($user_id);

    /**
     * @param User $user
     */
    public function tryNextLevel(User $user);

    /**
     * @param User $user
     */
    public function getNextLevelProgress(User $user);
}