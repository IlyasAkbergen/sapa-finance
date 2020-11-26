<?php

namespace App\Http\Requests\api;


use App\Http\Requests\ApiBaseRequest;

class PayboxResultRequest extends ApiBaseRequest
{
    public function injectedRules()
    {
        return [
            'pg_payment_id' => ['required'],
            'pg_order_id' => ['required'],
            'pg_amount' => ['required'],
            'pg_result' => ['required'],
            'pg_payment_date' => ['required'],
            'pg_can_reject' => ['required'],
            'pg_need_phone_notification' => ['required'],
            'pg_user_contact_email' => ['required'],
            'pg_need_email_notification' => ['required'],
            'pg_testing_mode' => ['required'],
            'pg_salt' => ['required'],
            'pg_sig'  => ['required'],
        ];
    }
}
