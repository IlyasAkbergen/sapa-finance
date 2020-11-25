<?php


namespace App\Services\Gates;


use App\Models\Purchase;

interface PaymentGateContract
{
    function setOrder(Purchase $purchasable);

    function setMode($mode);

    function redirectToPaymentPage();

    function setSuccessUrl($url);

    function setFailureUrl($url);
}