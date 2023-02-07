<?php

namespace Chartello\Lite\Http\Controllers;

use Chartello\Lite\Models\Dashboard;
use Chartello\Lite\Models\Panel;

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
            ->has(Panel::factory(1, ['name' => 'Users']))
            ->create(['name' => 'Overview']);

        return $overview;
    }
}
