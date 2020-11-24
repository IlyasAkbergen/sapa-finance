<?php


namespace App\Services;


use App\Interfaces\WithPurchase;
use App\Models\Purchase;

class PurchaseService extends BaseServiceImpl implements PurchaseServiceContract
{
    public function __construct(Purchase $model)
    {
        parent::__construct($model);
    }

    function addUsersToPurchasable(array $user_ids, WithPurchase $purchasable)
    {
        return $purchasable->users()->attach($user_ids);
    }
}