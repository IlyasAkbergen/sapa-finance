<?php


namespace App\Services;


use App\Interfaces\WithPurchase;

interface PurchaseServiceContract
{
    /**
     * @param array $user_ids
     * @param WithPurchase $purchasable
     * @param $consultant_id
     * @param $purchase
     */
    function addUsersToPurchasable(array $user_ids, WithPurchase $purchasable, $consultant_id, $purchase);

    /**
     * @param $user_id
     */
    function ofUser($user_id);
}