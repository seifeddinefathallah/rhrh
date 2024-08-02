<?php

return [

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'onesignal' => [
        'app_id' => env('ONESIGNAL_APP_ID'),
        'rest_api_key' => env('ONESIGNAL_REST_API_KEY'),
        'user_auth_key' => env('USER_AUTH_KEY'),
        'guzzle_client_timeout' => 30,
    ],

    'recaptcha' => [
        'recaptcha.site_key' => env('RECAPTCHA_SITE_KEY'),
        'recaptcha.secret_key' => env('RECAPTCHA_SECRET_KEY'),
    ],

    'guzzle' => [
        'timeout' => env('ONESIGNAL_GUZZLE_CLIENT_TIMEOUT', 3.0),
    ],


];
