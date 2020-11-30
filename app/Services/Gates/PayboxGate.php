<?php

namespace App\Services\Gates;

use App\Models\Payout;
use App\Models\Purchase;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Paybox\Pay\Facade as PayboxPay;
use Paybox\Payout\Facade as PayboxPayout;

class PayboxGate implements PaymentGateContract
{
    private $api_id;
    private $api_pay_in_key;
    private $api_pay_out_key;
    private $api;
    private $mode;
    private $config;

    // todo samples here: https://packagist.org/packages/payboxmoney/pay

    public function __construct()
    {
        $config = config('services.paybox');
        $this->config = $config;
        $this->api_id = $config['api_id'];
        $this->api_pay_in_key = $config['api_pay_in_key'];
        $this->api_pay_out_key = $config['api_pay_out_key'];
    }

    private function commonInit()
    {
        if (!empty($this->api)) {
            $this->setMerchant();
            $this->api->config->setIsTestingMode($this->config['testing_mode']);
        }
    }

    public function initPayin()
    {
        try{
            $this->setMode(self::MODE_PAY_IN);

            $this->api = new PayboxPay();

            $this->api->config->setSiteUrl($this->config['site_url']);
            $this->api->config->setResultUrl($this->config['site_url'] . '/' . $this->config['result_url']);
            $this->setSuccessUrl($this->config['site_url']);
            $this->commonInit();
        } catch (\Exception $e) {
            Log::critical($e->getMessage());
        }
    }

    public function initPayout()
    {
        try {
            $this->setMode(self::MODE_PAY_OUT);

            $this->api = new PayboxPayout();

            $this->api->config->setPostLink($this->config['site_url'] . '/' . $this->config['result_url']);
            $this->api->config->setBackLink($this->config['site_url']);
            $this->api->config->setOrderTimeLimit(Carbon::tomorrow()->endOfDay());
            $this->commonInit();
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
        $this->api->customer->setId($purchase->user->id);
    }

    public function setPayout(Payout $payout)
    {
        $payout->loadMissing('user');

        $this->api->order->setId($payout->id);
        $this->api->order->setAmount($payout->sum);
        $this->api->order->setDescription(
            'Вывод средств для пользователя: ' . $payout->user->email
        );
        $this->api->customer->setUserEmail($payout->user->email);
    }

    public function redirectToPaymentPage()
    {
        $this->api->init();
        header('Location:' . $this->api->redirectUrl);
    }

    public function redirectToPayoutPage()
    {
        $this->api->reg2nonreg();
        header('Location:' . $this->api->redirectUrl);
    }

    public function getRedirectUrl()
    {
        $this->init();
        $this->api->init();
        return $this->api->redirectUrl;
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
    function isStatusOk()
    {
        $result = false;
        try {
            $result = $this->api->getStatus() == self::PAYMENT_STATUS_OK;
        } catch (\Exception $e) {
            Log::critical($e->getTraceAsString());
            dd($e);
        }

        return $result;
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