<?php

namespace Chartello\Http\Controllers;

use Chartello\Models\Dashboard;

class DashboardPanelsController
{
    public function store(Dashboard $dashboard)
    {
        $panel = $dashboard->panels()->create();

        return redirect()->route('chartello.dashboards.show', [
            'dashboard' => $dashboard,
            'edit' => $panel,
        ]);
    }
}
