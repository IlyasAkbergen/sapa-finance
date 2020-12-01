<?php

namespace App\Http\Controllers\web;

use App\Http\Requests\PurchaseRequest;
use App\Services\Gates\PaymentGateContract;
use App\Services\PurchaseServiceContract;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends WebBaseController
{
    private $userService;
    private $purchaseService;
    private $paymentGate;

    public function __construct(
        UserService $userService,
        PurchaseServiceContract $purchaseService,
        PaymentGateContract $paymentGate
    ) {
        $this->userService = $userService;
        $this->purchaseService = $purchaseService;
        $this->paymentGate = $paymentGate;
    }

    public function index()
    {

    }

    public function my()
    {
//        DB::connection()->enableQueryLog();
        $purchases = $this->purchaseService->ofUser(Auth::user()->id);
//        dd(DB::getQueryLog());
//
//        dd($purchases);

        // todo render Inertia
    }

    public function store(PurchaseRequest $request)
    {
        // todo Пездюк потести этот момент
        $inputData = $request->only([
            'purchasable_id', 'purchasable_type', 'with_feedback'
        ]);

        $purchasable_class = $request->purchasable_type;

        $purchasable = $purchasable_class::find($request->purchasable_id);

        $inputData = array_merge($inputData, [
            'user_id' => Auth::user()->id,
            'sum' => $purchasable->getPurchaseSum($request->with_feedback)
        ]);

        $purchase = $this->purchaseService->create($inputData);

        if(empty($purchase->id)) {
            return $this->responseFail('Что-то пошло не так.');
        } else {
            $this->paymentGate->initPayin();
            $this->paymentGate->setOrder($purchase);
            $this->paymentGate->initPayment();

            $purchase->payments()->create([
                'eid' => $this->paymentGate->getPaymentId(),
                'redirect_url' => $this->paymentGate->getRedirectUrl()
            ]);

            header('Location:' . $this->paymentGate->getRedirectUrl());
        }
    }
}
