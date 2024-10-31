<?php

return [
    "service_id" => env('EGHL_SERVICE_ID', 'sit'),
    "password" => env('EGHL_PASSWORD', 'sit12345'),
    "service_url" => 'https://pay.e-ghl.com/IPGSG/Payment.aspx',
    "merchant_return_url" => env('APP_BASE_URL') . '/eghl',
    "merchant_approval_url" => env('APP_BASE_URL') . '/eghl/approval',
    "merchant_unapproval_url" => env('APP_BASE_URL') . '/eghl/unapproval',
    "merchant_callback_url" => env('APP_BASE_URL') . '/eghl/callback',
    "page_timeout" => 600,
    "transaction_type" => 'SALE',
    "payment_method" => 'ANY',
];
