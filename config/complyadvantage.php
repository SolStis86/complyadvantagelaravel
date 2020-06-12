<?php

use SolStis86\ComplyAdvantage\Controllers\WebhookController;

return [
    'api_key' => env('CA_API_KEY'),

    'database' => [
        'searches_table_name' => 'ca_searches',
    ],

    'allowed_entity_types' => [],

    'webhooks' => [
        'uri' => 'ca/webhooks',
        'controller' => WebhookController::class,
    ],
];
