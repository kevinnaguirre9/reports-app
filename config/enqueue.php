<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Enqueue Client Configuration
    |--------------------------------------------------------------------------
    |
    */

    'connections' => [
        'rabbitmq' => [
            'host' => env('RABBITMQ_HOST', 'rabbitmq-container-test'),
            'port' => env('RABBITMQ_PORT', 5672),
            'user' => env('RABBITMQ_USER', 'guest'),
            'password' => env('RABBITMQ_PASSWORD', 'guest'),
            'vhost' => env('RABBITMQ_VHOST', '/'),
            'exchange' => [
                'name' => env('RABBITMQ_EXCHANGE', 'sagittarius-a'),
                'type' => env('RABBITMQ_EXCHANGE_TYPE', 'topic'),
                'passive' => env('RABBITMQ_EXCHANGE_PASSIVE', true),
                'durable' => env('RABBITMQ_EXCHANGE_DURABLE', true),
                'auto_delete' => env('RABBITMQ_EXCHANGE_AUTO_DELETE', false),
                'internal' => env('RABBITMQ_EXCHANGE_INTERNAL', false),
                'nowait' => env('RABBITMQ_EXCHANGE_NOWAIT', false),
                'arguments' => [],
            ],
        ],
    ],
];
