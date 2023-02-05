<?php

namespace Chartello\Lite\Http\Controllers;

use Chartello\Lite\Aggregators\TrendAggregator;
use Chartello\Lite\Models\Dashboard;
use Inertia\Inertia;
use Throwable;

class DashboardsController
{
    public function show(Dashboard $dashboard)
    {
        $start = request('start', session('start', now()->endOfDay()->subMonths(3)->format('Y-m-d')));
        $end = request('end', session('end', now()->endOfDay()->format('Y-m-d')));

        session()->put('start', $start);
        session()->put('end', $end);

        $dashboard->load('panels');

        foreach ($dashboard->panels as $panel) {
            $query = data_get($panel, 'settings.query');

            if (! $query) {
                $panel->data = [];

                continue;
            }

            $aggregator = new TrendAggregator($query, $start, $end);

            try {
                $panel->data = $aggregator->get();
            } catch (Throwable $exception) {
                $panel->data = [];
                $panel->error = $exception->getMessage();
            }
        }

        Inertia::setRootView('chartello::app');

        Inertia::share('path', config('chartello.path'));

        return Inertia::render('Dashboards/Show', [
            'dashboard' => $dashboard,
            'links' => Dashboard::all(),
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
}
