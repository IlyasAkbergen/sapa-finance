<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\ApiBaseController;
use App\Services\PurchaseServiceContract;
use Illuminate\Http\Request;

class PurchaseController extends ApiBaseController
{
    private $purchaseService;

    public function __construct(PurchaseServiceContract $purchaseService)
    {
        $this->purchaseService = $purchaseService;
    }

    public function makePayed($id)
    {
        $payed = true; // todo check status through gate

        $purchase = $this->purchaseService->find($id);

        if (!isset($purchase)) {
            return $this->failedResponse([
                'message' => 'Not found.'
            ]);
        } else if($purchase->payed) {
            return $this->failedResponse([
                'message' => 'Already payed.'
            ]);
        }

        $purchase = $this->purchaseService->update($purchase->id, [
            'payed' => $payed
        ]);

        if ($purchase->payed) {
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
