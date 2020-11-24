<?php


namespace App\Services;


use App\Interfaces\WithPurchase;

interface PurchaseServiceContract
{
    /**
     * @param array $user_ids
     * @param WithPurchase $purchasable
     */
    function addUsersToPurchasable(array $user_ids, WithPurchase $purchasable);
}