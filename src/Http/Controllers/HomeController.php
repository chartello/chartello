<?php

namespace Chartello\Lite\Http\Controllers;

use Chartello\Lite\Models\Dashboard;

class HomeController
{
    public function index()
    {
        $dashboard = Dashboard::first();

        if (! $dashboard) {
            $dashboard = $this->initiate();
        }

        return redirect()->route('chartello.dashboards.show', $dashboard);
    }

    protected function initiate()
    {
        $overview = Dashboard::create(['name' => 'Overview']);

        $overview->panels()->create([
            'name' => 'Users',
            'settings' => [
                'query' => 'SELECT COUNT(*) AS y,
DATE(created_at) AS x
FROM users
WHERE created_at BETWEEN @start AND @end
GROUP BY x
ORDER BY x ASC',
            ],
        ]);

        return $overview;
    }
}
