<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\api\Paybox\payout\ResultRequest;
use App\Services\Gates\PaymentGateContract;
use App\Services\PayoutServiceContract;
use Illuminate\Http\Request;

class PayoutController extends ApiBaseController
{
    private $payoutService;
    private $paymentGate;

    public function __construct(
        PayoutServiceContract $payoutService,
        PaymentGateContract $paymentGate
    )
    {
        $this->payoutService = $payoutService;
        $this->paymentGate = $paymentGate;
    }

    public function makeCommitted(ResultRequest $request)
    {
        $this->paymentGate->initPayout();
        if (!$this->paymentGate->parseRequest($request)) {
            return $this->failedResponse([
                'message' => 'could not parse request.'
            ]);
        }

        if (!$this->$this->paymentGate->isStatusOk()) {
            return $this->failedResponse([
                'message' => 'Payment is not OK.'
            ]);
        }

        $payout = $this->payoutService->find(
            $this->paymentGate->getOrder()->id
        );

        if (!isset($payout)) {
            return $this->failedResponse([
                'message' => 'Not found.'
            ]);
        } else if($payout->committed) {
            return $this->failedResponse([
                'message' => 'Already committed.'
            ]);
        }

        $payout->setCommitted(
            $request->input('pg_payment_id', null)
        );

        if ($payout->committed) {

            $payment_id = $request->input('pg_payment_id', null);

            $payout->payments()->updateOrCreate([
                'eid' => $payment_id,
            ], [
                'status' => PaymentGateContract::PAYMENT_STATUS_OK
            ]);

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