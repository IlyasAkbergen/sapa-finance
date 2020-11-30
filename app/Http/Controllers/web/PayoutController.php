<?php

namespace App\Http\Controllers\web;

use App\Services\Gates\PaymentGateContract;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $this->userService = $userService;
    }

    public function store(Request $request)
    {
        $request->validate([
            'sum' => 'required',
        ]);

        $payout = $this->userService->addPayout(
            Auth::user()->id,
            ['sum' => $request->only('sum')]
        );

        if (empty($payout)) {
            return $this->responseFail('Вывод средств на данную сумму невозможен.');
        }

        $this->paymentGate->initPayout();

        $this->paymentGate->setPayout($payout);

        $this->paymentGate->redirectToPayoutPage();
    }
}
