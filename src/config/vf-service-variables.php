<?php
return [
    'mainDomain'        => env('VF_SERVICE_URL', false),
    'tokenUri'          => env('VF_SERVICE_TOKEN_URI', false),
    'SendSmsUri'        => env('VF_SERVICE_SMS_ONE', false),
    'SendMultipleUri'   => env('VF_SERVICE_SMS_MULTIPLE', false),
    'user'              => env('VF_SERVICE_USER', false),
    'password'          => env('VF_SERVICE_PASSWORD', false)
];
