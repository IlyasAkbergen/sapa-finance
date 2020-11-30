<?php


namespace App\Services;


use App\Models\Payout;

class PayoutService extends BaseServiceImpl implements PayoutServiceContract
{
    public function __construct(Payout $model)
    {
        parent::__construct($model);
    }
}