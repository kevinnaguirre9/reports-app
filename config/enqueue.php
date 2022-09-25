<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Enqueue Client Configuration
    |--------------------------------------------------------------------------
    |
    */

    'client' => [
        'transport' => [
            'dsn' => env('ENQUEUE_DSN', 'amqp:'),
        ],
        'client' => [
            'router_topic' => env('RABBITMQ_EXCHANGE', 'reports-app-exchange'), // Exchange Name
            'router_queue' => env('APP_NAME', 'domain.reports-app'),
            'default_queue' => env('APP_NAME', 'domain.reports-app'),
            'prefix' => '',
            'separator' => '.',
            'app_name' => '' // Consumer Queue
        ],
        'extensions' => [
            'reply_extension' => true,
        ]
    ],

    'test_client' => [
        'transport' => [
            'dsn' => env('ENQUEUE_DSN', 'amqp:'),
        ],
        'client' => [
            'router_topic' => 'reports-app-exchange-test', // Exchange Name
            'router_queue' => 'domain.reports-app-test',
            'default_queue' => 'domain.reports-app-test',
            'prefix' => '',
            'separator' => '.',
            'app_name' => '' // Consumer Queue
        ],
        'extensions' => [
            'reply_extension' => true,
        ]
    ],
];
