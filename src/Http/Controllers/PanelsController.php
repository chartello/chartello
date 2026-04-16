<?php

namespace Chartello\Http\Controllers;

use Chartello\Models\Panel;

class PanelsController
{
    public function update(Panel $panel)
    {
        $panel->update([
            'name' => request('name'),
            'type' => request('type'),
            'settings' => [
                'query' => request('query'),
            ],
        ]);

        $start = session('start');
        $end = session('end');
        $panel->populate($start, $end);

        return response()->json(['panel' => $panel]);
    }

    public function destroy(Panel $panel)
    {
        $panel->delete();

        return response()->json(['success' => true]);
    }
}
