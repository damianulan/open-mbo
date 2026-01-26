<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Laravel Feature Kit Configuration file v1.0
    |--------------------------------------------------------------------------
    |
    | These are package's default configuration options.
    |
    */

    // choose connection driver - for 'database' need to run a migration
    'connection' => env('FEATUREKIT_CONNECTION', 'database'),

    'drivers' => [
        'database' => [
            'table_name' => 'features',
        ],
        'json' => [
            'storage_path' => storage_path('features'),
        ],
    ],

    // use cache to store registered and discovered features
    'cache' => [
        'enabled' => true,
        // in minutes
        'ttl' => 300,
    ],

    'features' => [
        // here declare feature namespaces you want to register
        // that may not be autoloaded.

    ],
];
