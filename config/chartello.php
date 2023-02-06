<?php

return [
    'path' => env('CHARTELLO_PATH', 'chartello'),

    'middleware' => [
        'web',
        Chartello\Lite\Http\Middleware\HandleInertiaRequests::class,
        App\Http\Middleware\ProtectChartello::class,
    ],
];
