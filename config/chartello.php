<?php

return [
    'path' => env('CHARTELLO_PATH', 'chartello'),

    'middleware' => [
        'web',
        App\Http\Middleware\ProtectChartello::class,
    ],

    'autocompletion' => [
        'enabled' => true,
    ],
];
