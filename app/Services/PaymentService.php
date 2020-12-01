<?php


namespace App\Services;


use App\Models\Payment;

class PaymentService extends BaseServiceImpl implements PaymentServiceContract
{
    public function __construct(Payment $model)
    {
        parent::__construct($model);
    }
}