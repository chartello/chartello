<?php

namespace Chartello\Lite\Http\Controllers;

use Chartello\Lite\Models\Dashboard;
use Inertia\Inertia;

class DashboardsController
{
    public function show(Dashboard $dashboard)
    {
        [$start, $end] = $this->resolveRenage();

        $dashboard->load('panels');

        foreach ($dashboard->panels as $panel) {
            $panel->populate($start, $end);
        }

        return Inertia::render('Dashboards/Show', [
            'dashboard' => $dashboard,
            'dashboards' => Dashboard::all(),
            'start' => $start,
            'end' => $end,
        ]);
    }

    public function store()
    {
        $dashboard = Dashboard::create();

        $dashboard->panels()->create();

        return redirect()->route('chartello.dashboards.show', $dashboard);
    }

    public function update(Dashboard $dashboard)
    {
        $dashboard->update(request(['name']));

        return back();
    }

    public function destroy(Dashboard $dashboard)
    {
        $previous = Dashboard::where('id', '<', $dashboard->id)->orderBy('id', 'desc')->first();

        $dashboard->delete();

        return redirect()->route('chartello.dashboards.show', $previous ?? Dashboard::first());
    }

    protected function resolveRenage()
    {
        $start = request('start', session('start'));
        $end = request('end', session('end'));

        if (! $start) {
            $start = now()->endOfDay()->subMonths(3)->format('Y-m-d');
        }

        if (! $end) {
            $end = now()->endOfDay()->format('Y-m-d');
        }

        session()->put('start', $start);
        session()->put('end', $end);

        return [$start, $end];
    }
}
