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

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_SECRET_KEY'),
        'redirect' => env('GOOGLE_CALLBACK_URL'),
    ],

    // 'facebook' => [
    //     'client_id' => '876464426385062',
    //     'client_secret' => 'c992ca647bde7834bec877acda6d8bfds',
    //     'redirect' => '/auth/facebook/callback',
    // ],
    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
        'redirect' => env('FACEBOOK_CALLBACK'),
    ],

    'twitter' => [
        'client_id' => 'xhddTOT62c98iK2nA5easDHjw',
        'client_secret' => '1Yik0R0dDtJXzBJeMKEmoMKci3g3AeOLh6ZB9JP9WNDE8DuMCD',
        'redirect' => '/twitter/callback',
    ],

];
