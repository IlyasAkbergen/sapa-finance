<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\api\PayboxResultRequest;
use App\Services\Gates\PaymentGateContract;
use App\Services\PurchaseServiceContract;
use Illuminate\Http\Request;

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

    public function makePayed(PayboxResultRequest $request)
    {
        if (!$this->paymentGate->parseRequest($request) ) {
            return $this->failedResponse([
                'message' => 'could not parse request.'
            ]);
        }

        $payed = $this->paymentGate->isPayed();

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

        $purchase->setPayed();

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
