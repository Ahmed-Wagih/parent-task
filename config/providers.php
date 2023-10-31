<?php

return [
    'DataProviderX' => [
        'file' => 'DataProviderX.json',
        'name' => 'DataProviderX',
        'statusEnum' => [
            'authorised' => 1,
            'decline' => 2,
            'refunded' => 3
        ],
        'schema' => [
            'parentAmount',
            'currency',
            'parentEmail',
            'statusCode',
            'registerationDate',
            'parentIdentification',
        ],
    ],
    'DataProviderY' => [
        'file' => 'DataProviderY.json',
        'name' => 'DataProviderY',
        'statusEnum' => [
            'authorised' => 100,
            'decline' => 200,
            'refunded' => 300
        ],
        'schema' => [
            'balance',
            'currency',
            'email',
            'status',
            'created_at',
            'id',
        ],
    ],
    // You ca add DataProviderZ
];
