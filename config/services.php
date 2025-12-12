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

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'tw_diw' => [
        'issuer_base_url' => env('TW_DIW_ISSUER_BASE_URL', 'https://issuer-sandbox.wallet.gov.tw'),
        'issuer_token' => env('TW_DIW_ISSUER_SANDBOX_TOKEN'),
        'verifier_base_url' => env('TW_DIW_VERIFIER_BASE_URL', 'https://verifier-sandbox.wallet.gov.tw'),
        'verifier_token' => env('TW_DIW_VERIFIER_SANDBOX_TOKEN'),
    ],

];
