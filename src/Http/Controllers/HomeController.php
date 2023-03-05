<?php

namespace Chartello\Http\Controllers;

use Chartello\Models\Dashboard;

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
            'name' => 'Recent Users',
            'settings' => [
                'query' => file_get_contents(__DIR__.'/../../../database/examples/table.sql'),
            ],
        ]);

        $overview->panels()->create([
            'name' => 'Users',
            'settings' => [
                'query' => file_get_contents(__DIR__.'/../../../database/examples/trend-chart.sql'),
            ],
        ]);

        return $overview;
    }
}
