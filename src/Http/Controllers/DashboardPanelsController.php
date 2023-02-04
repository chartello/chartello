<?php

namespace Chartello\Lite\Http\Controllers;

use Chartello\Lite\Models\Dashboard;

class DashboardPanelsController
{
    public function store(Dashboard $dashboard)
    {
        $panel = $dashboard->panels()->create();

        return redirect()->route('dashboards.show', [
            'dashboard' => $dashboard,
            'edit' => $panel,
        ]);
    }
}
