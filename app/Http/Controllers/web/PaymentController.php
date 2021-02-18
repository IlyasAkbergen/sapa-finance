<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use App\Services\PaymentService;
use App\Services\PaymentServiceContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PaymentController extends Controller
{
    private $paymentService;

    public function __construct(
        PaymentServiceContract $paymentService
    )
    {
        $this->paymentService = $paymentService;
    }

    public function my(Request $request)
    {
        $data = Payment::query()
            ->where('user_id', Auth::user()->id)
            ->with('payable.purchasable')
            ->with('user')
            ->where(
                'status',
                Payment::PAYMENT_STATUS_OK
            )
            ->orderByDesc('paid_at')
            ->paginate(20);

        return Inertia::render('Payments/Index', [
            'data' => $data,
            'payments' => PaymentResource::collection(
                $data->items()
            )
            ->resolve()
        ]);
    }
}
