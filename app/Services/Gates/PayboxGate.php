<?php

namespace App\Services\Gates;

use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Paybox\Pay\Facade as Paybox;

class PayboxGate implements PaymentGateContract
{
    private $api_id;
    private $api_pay_in_key;
    private $api_pay_out_key;
    private $api;
    private $mode;

    const MODE_PAY_IN = 1;
    const MODE_PAY_OUT = 2;
    const PAYMENT_STATUS_OK = 'ok';

    // todo samples here: https://packagist.org/packages/payboxmoney/pay

    public function __construct()
    {
        $config = config('services.paybox');
        $this->api_id = $config['api_id'];
        $this->api_pay_in_key = $config['api_pay_in_key'];
        $this->api_pay_out_key = $config['api_pay_out_key'];

        try{
            $this->api = new Paybox();
            $this->setMode(self::MODE_PAY_IN);
            $this->api->config->setSiteUrl($config['site_url']);
            $this->api->config->setResultUrl($config['site_url'] . '/' . $config['result_url']);
            $this->api->config->setIsTestingMode($config['testing_mode']);

        } catch (\Exception $e) {
            Log::critical($e->getMessage());
        }
    }

    public function setMode($mode)
    {
        $this->mode = $mode;
    }

    public function setMerchant()
    {
        $this->api->merchant->setId($this->api_id);
        $this->api->merchant->setSecretKey($this->getApiKey());
    }

    public function init()
    {
        $this->setMerchant();
        $this->api->init();
    }

    private function getApiKey()
    {
        return $this->mode == self::MODE_PAY_IN
            ? $this->api_pay_in_key
            : $this->api_pay_out_key;
    }

    public function setSuccessUrl($url)
    {
        $this->api->config->setSuccessUrl($url);
    }

    public function setFailureUrl($url)
    {
        $this->api->config->setFailureUrl($url);
    }

    public function setOrder(Purchase $purchase)
    {
        $purchase->loadMissing('purchasable', 'user');

        $this->api->order->setId($purchase->id);
        $this->api->order->setAmount($purchase->sum);
        $this->api->order->setDescription($purchase->purchasable->getDescription());
        $this->api->customer->setUserEmail($purchase->user->email);
    }

    public function redirectToPaymentPage()
    {
        $this->init();
        header('Location:' . $this->api->redirectUrl);
    }

    /**
     * partial|pending|ok|failed|revoked|incomplete
     * @param $purchase
     * @return \Paybox\Pay\Exception|string
     */
    function getStatus($purchase = null)
    {
        if (!empty($purchase)) {
            $this->setOrder($purchase);
            $this->init();
        }

        return $this->api->getStatus();
    }

    /**
     * @inheritDoc
     */
    function isPayed($purchase = null)
    {
        $payed = false;
        try {
            $payed = $this->getStatus($purchase) == self::PAYMENT_STATUS_OK;
        } catch (\Exception $e) {
            Log::critical($e->getTraceAsString());
            dd($e);
        }

        return $payed;
    }

    public function parseRequest($request)
    {
        $this->setMerchant();
        $this->api->payment->id = $request->input('pg_payment_id');
        $this->api->order->id = $request->input('pg_order_id');

        return $this->api->checkSig($request->all()) && $request->input('pg_result');
    }

    public function accept()
    {
        $this->api->accept('Ok. Order handled');
    }

    public function getOrder()
    {
        return $this->api->order;
    }
}