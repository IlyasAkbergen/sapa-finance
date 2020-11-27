<?php

namespace App\Http\Controllers\web;

use App\Services\Gates\PaymentGateContract;
use App\Services\UserService;
use Illuminate\Http\Request;

class PayoutController extends WebBaseController
{
    private $paymentGate;
    private $userService;

    public function __construct(
        PaymentGateContract $paymentGate,
        UserService $userService
    )
    {
        $this->paymentGate = $paymentGate;
    }
}
