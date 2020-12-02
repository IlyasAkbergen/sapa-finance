<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\api\Paybox\pay\ResultRequest;
use App\Services\Gates\PaymentGateContract;
use App\Services\PurchaseServiceContract;
use Illuminate\Support\Facades\DB;

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
        try {
            DB::beginTransaction();
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

            $purchase = $this->purchaseService->findWith(
                $this->paymentGate->getOrder()->id,
                ['purchasable', 'payments']
            );


            if (!isset($purchase)) {
                return $this->failedResponse([
                    'message' => 'Not found.'
                ]);
            } else if($purchase->payed && !$purchase->purchasable->isPartPaid) {
                return $this->failedResponse([
                    'message' => 'Already payed.'
                ]);
            }

            $payment_id = $request->input('pg_payment_id', null);
            $payed_sum = $request->input('pg_amount', null);

            $purchase->payments()->updateOrCreate([
                'eid' => $payment_id,
            ], [
                'status' => PaymentGateContract::PAYMENT_STATUS_OK,
                'sum' => $payed_sum
            ]);

//            $part_payments_sum = $purchase->payments->where('status', PaymentGateContract::PAYMENT_STATUS_OK)
//                ->sum('sum');
//
//            if (!$purchase->purchasable->isPartPaid || $purchase->sum <= $part_payments_sum) {
                $purchase->setPayed();
//            }

            $this->paymentGate->accept();

            DB::commit();

            return $this->successResponse([
               'message' => 'Successfully received.'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->failedResponse([
                'message' => 'Something went wrong.'
            ]);
        }
    }
}
