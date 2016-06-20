<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    // Socialite
    'facebook' => [
        'client_id'     => env('FB_APP_ID'),
        'client_secret' => env('FB_APP_SECRET'),
        'redirect'      => env('FB_APP_CALLBACK'),
    ],

    'payfort' => [
        'url' => env('PAYFORT_URL'),
        'page' => env('PAYFORT_PAGE'),
        'access_code' => env('PAYFORT_ACCESS_CODE', 'tgdSdpqsmzxwjZqCqTLs'),
        'request_phrase' => env('PAYFORT_REQUEST_PHRASE'),
        'response_phrase' => env('PAYFORT_RESPONSE_PHRASE'),
        'id' => env('PAYFORT_IDENTIFIER')
    ],

    'yahoo' => [
        'id' => env('YAHOO_CLIENT_ID'),
        'secret' => env('YAHOO_CLIENT_SECRET')
    ]
];
