<?php

namespace App\Http\Controllers;

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
        // todo check status through gate

        $purchase = $this->purchaseService->find($id);

        if (!isset($purchase) || $purchase->payed) {
            return $this->failedResponse([
                'message' => 'Already payed.'
            ]);
        }

        $purchase = $this->purchaseService->update($purchase->id, [
            'payed' => true
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
