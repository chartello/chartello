<?php

namespace Chartello\Http\Controllers;

use Chartello\Database\Schema;
use Chartello\Models\Dashboard;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardsController
{
    public function show(Dashboard $dashboard)
    {
        [$start, $end] = $this->resolveRenage();

        $dashboard->load('panels');

        foreach ($dashboard->panels as $panel) {
            $panel->populate($start, $end);
        }

        $schema = config('chartello.autocompletion.enabled', true) ?
            new Schema(DB::connection()->getDatabaseName()) : [];

        return view('chartello::app', [
            'chartello' => [
                'path' => url(config('chartello.path')),
                'dashboard' => $dashboard,
                'dashboards' => Dashboard::all(),
                'start' => $start,
                'end' => $end,
                'schema' => $schema,
            ],
        ]);
    }

    public function store()
    {
        $dashboard = Dashboard::create();

        $dashboard->panels()->create();

        return response()->json([
            'redirect' => route('chartello.dashboards.show', $dashboard),
        ]);
    }

    public function update(Dashboard $dashboard)
    {
        $dashboard->update(request(['name']));

        return response()->json(['success' => true]);
    }

    public function destroy(Dashboard $dashboard)
    {
        $previous = Dashboard::where('id', '<', $dashboard->id)->orderBy('id', 'desc')->first();

        $dashboard->delete();

        $redirect = $previous
            ? route('chartello.dashboards.show', $previous)
            : route('chartello.home');

        return response()->json(['redirect' => $redirect]);
    }

    protected function resolveRenage()
    {
        $start = request('start', session('start'));
        $start = is_numeric($start) ? Carbon::createFromTimestampMs($start) : $start;

        $end = request('end', session('end'));
        $end = is_numeric($end) ? Carbon::createFromTimestampMs($end) : $end;

        if (! $start || ! $end) {
            $start = now()->endOfDay()->subMonths(3)->format('Y-m-d');
            $end = now()->endOfDay()->format('Y-m-d');
        }

        session()->put('start', $start);
        session()->put('end', $end);

        return [$start, $end];
    }
}
