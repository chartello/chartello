<?php

namespace Chartello\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'chartello::app';

    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            'path' => config('chartello.path'),
        ]);
    }
}
