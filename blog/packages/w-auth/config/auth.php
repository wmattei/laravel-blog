<?php
return [
    'register' => [
        'enable' => true
    ],
    'guards' => [
        'api' => [
            'driver' => 'jwt',
            'provider' => 'users',
        ],
    ],
];
