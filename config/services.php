<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'paybox' => [
        'api_id' => env('PAYBOX_ID'),
        'api_pay_in_key' => env('PAYBOX_PAY_IN_KEY'),
        'api_pay_out_key' => env('PAYBOX_PAY_OUT_KEY'),
        'testing_mode' => env('PAYBOX_TESTING_MODE', false),
        'pay_result_url' => env('PAYBOX_PAY_RESULT_URL', 'api/pay/result'),
        'payout_result_url' => env('PAYBOX_PAYOUT_RESULT_URL', 'api/payout/result'),
        'site_url' => env('APP_URL'),
        'check_url' => env('PAYBOX_CHECK_URL', 'must-be-check-url'),
        'success_url' => env('PAYBOX_SUCCESS_URL', 'must-be-check-url'),
    ]
];
