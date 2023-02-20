<?php

return [
    'path' => env('CHARTELLO_PATH', 'chartello'),

    'middleware' => [
        'web',
        Chartello\Http\Middleware\HandleInertiaRequests::class,
        App\Http\Middleware\ProtectChartello::class,
    ],

    'autocompletion' => [
        'enabled' => true,
    ],
];
