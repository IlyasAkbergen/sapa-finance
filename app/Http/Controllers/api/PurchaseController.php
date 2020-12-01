<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\api\Paybox\pay\ResultRequest;
use App\Services\Gates\PaymentGateContract;
use App\Services\PurchaseServiceContract;

class PurchaseController extends ApiBaseController
{
    private $purchaseService;
    private $paymentGate;

    public function __construct(
        PurchaseServiceContract $purchaseService,
        PaymentGateContract $paymentGate
    ) {
        $this->purchaseService = $purchaseService;
        $this->paymentGate = $paymentGate;
    }

    public function makePayed(ResultRequest $request)
    {
        // todo add payments

        $this->paymentGate->initPayin();
        if (!$this->paymentGate->parseRequest($request) ) {
            return $this->failedResponse([
                'message' => 'could not parse request.'
            ]);
        }

        if (!$this->paymentGate->isStatusOk()) {
            return $this->failedResponse([
                'message' => 'Payment is not OK.'
            ]);
        }

        $purchase = $this->purchaseService->find(
            $this->paymentGate->getOrder()->id
        );

        if (!isset($purchase)) {
            return $this->failedResponse([
                'message' => 'Not found.'
            ]);
        } else if($purchase->payed) {
            return $this->failedResponse([
                'message' => 'Already payed.'
            ]);
        }

        $purchase->setPayed(
            $request->input('pg_payment_id', null)
        );

        if ($purchase->payed) {

            $this->paymentGate->accept();

            return $this->successResponse([
               'message' => 'Successfully received.'
            ]);
        } else {
            return $this->failedResponse([
                'message' => 'Something went wrong.'
            ]);
        }
    }
}
