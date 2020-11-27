<?php


namespace App\Services\Gates;


use App\Models\Purchase;
use Illuminate\Http\Request;

interface PaymentGateContract
{
    function setOrder(Purchase $purchasable);

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