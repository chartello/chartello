<?php

namespace Chartello\Http\Controllers;

use Chartello\Models\Dashboard;
use Chartello\Models\Panel;

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
        $overview = Dashboard::factory()
            ->create(['name' => 'Overview']);

        Panel::factory()->table()->create([
            'name' => 'Recent Users',
            'dashboard_id' => $overview->id,
        ]);

        Panel::factory()->create([
            'name' => 'Users',
            'dashboard_id' => $overview->id,
        ]);

        return $overview;
    }
}
