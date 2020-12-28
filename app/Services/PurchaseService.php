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

    function addUsersToPurchasable(array $user_ids, WithPurchase $purchasable, $consultant_id)
    {
        $purchasable->users()->detach($user_ids);

        return $purchasable->users()->attach($user_ids, [
            'consultant_id' => $consultant_id,
            'paid' => true
        ]);
    }

    function ofUser($user_id)
    {
        $this->with(['purchasable']);
        return $this->firstWhere(['user_id' => $user_id]);
    }
}