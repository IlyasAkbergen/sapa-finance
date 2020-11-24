<?php

namespace App\Services\Gates;

use Illuminate\Support\Facades\Log;
use Paybox\Pay\Facade as Paybox;

class PayboxGate implements PaymentGateContract
{
    private $api_id;
    private $api_key;
    private $api;

    // todo samples here: https://packagist.org/packages/payboxmoney/pay

    public function __construct()
    {
        $config = config('services.paybox');
        $this->api_id = $config['api_id'];
        $this->api_key = $config['api_key'];

        try{
            $this->api = new Paybox();

            $this->api->getMerchant()->setId($this->api_id);
            $this->api->getMerchant()->setSecretKey($this->api_key);

        } catch (\Exception $e) {
            Log::critical($e->getMessage());
        }
    }
}