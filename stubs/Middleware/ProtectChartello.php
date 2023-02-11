<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\App;

class ProtectChartello
{
    /**
     * Hide Chartello unless authorized.
     *
     * @param $request
     * @param $next
     * @return mixed|never
     */
    public function handle($request, $next)
    {
        if (! $this->authorize($request)) {
            abort(404);
        }

        return $next($request);
    }

    /**
     * Define the authorization logic for accessing Chartello.
     *
     * @param $request
     * @return bool
     */
    protected function authorize($request)
    {
        if (App::environment('local')) {
            return true;
        }

        return $request->user() && in_array($request->user()->email, [
            //
        ]);
    }
}
