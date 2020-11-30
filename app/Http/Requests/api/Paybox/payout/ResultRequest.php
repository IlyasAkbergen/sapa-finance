<?php

namespace App\Http\Requests\api\Paybox\payout;

use App\Http\Requests\ApiBaseRequest;

class ResultRequest extends ApiBaseRequest
{
    // example request
    //[pg_status] => ok
    //[pg_payment_id] => 12345678
    //[pg_order_id] => 157674271
    //[pg_balance] => 13476085.15
    //[pg_payment_amount] => 5000.00
    //[pg_to_pay] => 5300
    //[pg_merchant_id] => 123456
    //[pg_payment_date] => 2018-12-31 15:00:00
    //[pg_card_hash] => 123456-XX-XXXX-1234
    //[pg_salt] => G66PbiRDxqa44tB8
    //[pg_sig] => ae7a022b66c6e866742ab2f99ef8f24f

    public function injectedRules()
    {
        return [
            'pg_status' => ['required'],
            'pg_payment_id' => ['required'],
            'pg_order_id' => ['required'],
            'pg_balance' => ['required'],
            'pg_payment_amount' => ['required'],
            'pg_to_pay' => ['required'],
            'pg_merchant_id' => ['required'],
            'pg_payment_date' => ['required'],
            'pg_card_hash' => ['required'],
            'pg_salt' => ['required'],
            'pg_sig' => ['required'],
        ];
    }
}
