<?php


namespace App\Services\Gates;


use App\Models\Payout;
use App\Models\Purchase;
use Illuminate\Http\Request;

interface PaymentGateContract
{
    const MODE_PAY_IN = 1;
    const MODE_PAY_OUT = 2;
    const PAYMENT_STATUS_OK = 'ok';

    function setOrder(Purchase $purchasable);

    function setPayout(Payout $payout);

    function setMode($mode);

    function redirectToPaymentPage();

    function setSuccessUrl($url);

    function setFailureUrl($url);

    /**
     * @param $purchase Purchase
     */
    function getStatus($purchase = null);

    /**
     * @param $purchase Purchase
     * @return boolean
     */
    function isPayed($purchase = null);

    /**
     * @param $request
     * @return boolean
    */
    function parseRequest($request);

    function accept();

    function getOrder();

    function getRedirectUrl();
}