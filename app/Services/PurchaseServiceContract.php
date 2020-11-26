<?php


namespace App\Services;


use App\Interfaces\WithPurchase;

interface PurchaseServiceContract
{
    /**
     * @param array $user_ids
     * @param WithPurchase $purchasable
     * @param $consultant_id
     */
    function addUsersToPurchasable(array $user_ids, WithPurchase $purchasable, $consultant_id);

    /**
     * @param $user_id
     */
    function ofUser($user_id);
}