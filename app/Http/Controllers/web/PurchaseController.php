<?php

namespace App\Http\Controllers\web;

use App\Http\Requests\PurchaseRequest;
use App\Models\Course;
use App\Models\UserCourse;
use App\Services\Gates\PaymentGateContract;
use App\Services\PurchaseServiceContract;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PurchaseController extends WebBaseController
{
    private $userService;
    private $purchaseService;
    private $paymentGate;

    public function __construct(
        UserService $userService,
        PurchaseServiceContract $purchaseService,
        PaymentGateContract $paymentGate
    )
    {
        $this->userService = $userService;
        $this->purchaseService = $purchaseService;
        $this->paymentGate = $paymentGate;
    }

    public function index()
    {
        // FOR TEST ONLY

        $inputData = [
            'purchasable_id' => 1,
            'purchasable_type' => Course::class,
            'with_feedback' => true
        ];

        $purchasable_class = Course::class;

        $purchasable = $purchasable_class::find(1);

        $params = [
            'user_id' => Auth::user()->id,
            'payed' => false,
            'purchasable_id' => $inputData['purchasable_id'],
            'purchasable_type' => $inputData['purchasable_type'],
        ];

        $inputData['sum'] = $purchasable->getPurchaseSum(true);

        $purchase = $this->purchaseService->updateOrCreate(
            $params,
            $inputData
        );

        if (empty($purchase->id)) {
            return $this->responseFail('Что-то пошло не так.');
        } else {
            $this->paymentGate->initPayin();
            $this->paymentGate->setOrder($purchase);

            if ($purchasable->isPartPaid) {
                $this->paymentGate->setAmount($purchasable->monthly_payment);
            }

            $this->paymentGate->initPayment();

            $purchase->payments()->create([
                'eid' => $this->paymentGate->getPaymentId(),
                'redirect_url' => $this->paymentGate->getRedirectUrl(),
                'status' => PaymentGateContract::PAYMENT_STATUS_CREATED
            ]);

            header('Location:' . $this->paymentGate->getRedirectUrl());
        }
    }

    public function my()
    {
//        DB::connection()->enableQueryLog();
        $purchases = $this->purchaseService->ofUser(Auth::user()->id);
//        dd(DB::getQueryLog());
//
        dd($purchases);

        // todo render Inertia
    }

    public function store(PurchaseRequest $request)
    {
        $inputData = $request->only([
            'purchasable_id', 'purchasable_type', 'with_feedback', 'pay_online'
        ]);

        $purchasable_class = $request->purchasable_type;

        $purchasable = $purchasable_class::find($request->purchasable_id);

        $params = [
            'user_id' => Auth::user()->id,
            'payed' => false,
            'purchasable_id' => $inputData['purchasable_id'],
            'purchasable_type' => $inputData['purchasable_type'],
        ];

        $inputData['sum'] = $purchasable->getPurchaseSum($request->with_feedback);

        $purchase = $this->purchaseService->updateOrCreate(
            $params, $inputData
        );

        if (empty($purchase->id)) {
            return $this->responseFail('Что-то пошло не так.');
        } else {
            if (!$request->pay_online) {

                UserCourse::create([
                    'status' => UserCourse::STATUS_PENDING,
                    'paid' => 0,
                    'purchase_id' => $purchase->id,
                    'user_id' => $purchase->user_id,
                    'course_id' => $purchase->purchasable_id,
                    'with_feedback' => $request->with_feedback,
                    'consultant_id' => Auth::user()->referrer_id ?: config('app.super_referrer_id')
                ]);

                return redirect()
                    ->route('my-courses')
                    ->with([
                        'message' => 'Заявка на курс отправлена.',
                        'sub_message' => 'Ожидайте ответа администратора.'
                    ]);
            }

            $this->paymentGate->initPayin();
            $this->paymentGate->setOrder($purchase);

            if ($purchasable->isPartPaid) {
                $this->paymentGate->setAmount($purchasable->monthly_payment);
            }

            $this->paymentGate->initPayment();

            $purchase->payments()->create([
                'eid' => $this->paymentGate->getPaymentId(),
                'redirect_url' => $this->paymentGate->getRedirectUrl(),
                'status' => PaymentGateContract::PAYMENT_STATUS_CREATED,
                'user_id' => Auth::user()->id
            ]);

            return Inertia::location(
                $this->paymentGate->getRedirectUrl()
            );
        }
    }
}
