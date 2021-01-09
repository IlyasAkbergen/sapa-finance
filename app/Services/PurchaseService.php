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

    function addUsersToPurchasable(
        array $user_ids,
        WithPurchase $purchasable,
        $consultant_id,
        $purchase
    )
    {
        $purchasable->users()->detach($user_ids);

        return $purchasable->users()->attach($user_ids, [
            'consultant_id' => $consultant_id,
            'paid' => true,
            'purchase_id' => data_get($purchase, 'id'),
            'with_feedback' => data_get($purchase, 'with_feedback')
        ]);
    }

    function ofUser($user_id)
    {
        $this->with(['purchasable']);
        return $this->firstWhere(['user_id' => $user_id]);
    }
}