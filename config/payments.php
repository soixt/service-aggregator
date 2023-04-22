<?php

return [
    'flutterwave' => [
        'url' => [
            'production' => 'https://api.flutterwave.com',
            'resolve' => '/v3/accounts/resolve',
            'pay' => '/v3/payments',
            'pay_status' => '/v3/transactions/%s/verify',
            'withdraw' => '/v3/transfers',
            'withdraw_status' => '/v3/transfers/%s',
            'success_redirect' => config('url') . '/flutterwave/success',
            'failed_redirect' => config('url') . '/flutterwave/failed',
        ]
    ],
    'opay' => [
        'url' => [
            'production' => 'https://cashierapi.opayweb.com',
            'pay' => '/api/v3/cashier/initialize',
            'pay_status' => '/cashier/status',
            'withdraw' => '/transfer/toBank',
            'withdraw_status' => '/transfer/status/toBank',
            'success_redirect' => config('url') . '/opay/success',
            'failed_redirect' => config('url') . '/opay/failed',
        ]
    ]
];