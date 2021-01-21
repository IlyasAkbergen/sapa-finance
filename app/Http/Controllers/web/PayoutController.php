<?php

namespace App\Http\Controllers\web;

use App\Services\Gates\PaymentGateContract;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

    public function index()
    {
        // ONLY FOR TEST
        $payout = $this->userService->addPayout(
            Auth::user()->id,
            ['sum' => 222]
        );

        if (empty($payout->id)) {
            return redirect()->withErrors([
                'Вывод средств на данную сумму невозможен.'
            ]);
        }

        $this->paymentGate->initPayout();
        $this->paymentGate->setPayout($payout);
        $this->paymentGate->reg2nonreg();

        $payout->payments()->create([
            'eid' => $this->paymentGate->getPaymentId(),
            'redirect_url' => $this->paymentGate->getRedirectUrl(),
            'status' => PaymentGateContract::PAYMENT_STATUS_CREATED
        ]);

        header('Location:' . $this->paymentGate->getRedirectUrl());
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'sum' => 'required',
        ], [
            'sum.required' => 'Укажите сумму для вывода средств'
        ])->validate();

        $payout = $this->userService->addPayout(
            Auth::user()->id,
            $request->only('sum')
        );

        if (empty($payout->id)) {
            return redirect()
                ->back()
                ->withErrors([
                    'sum' => 'Вывод средств на данную сумму невозможен.'
                ]);
        }

        $this->paymentGate->initPayout();
        $this->paymentGate->setPayout($payout);
        $this->paymentGate->reg2nonreg();

        $payout->payments()->create([
            'eid' => $this->paymentGate->getPaymentId(),
            'redirect_url' => $this->paymentGate->getRedirectUrl(),
            'status' => PaymentGateContract::PAYMENT_STATUS_CREATED
        ]);

        header('Location:' . $this->paymentGate->getRedirectUrl());
    }
}
