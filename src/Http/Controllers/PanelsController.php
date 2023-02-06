<?php

namespace Chartello\Lite\Http\Controllers;

use Chartello\Lite\Models\Panel;

class PanelsController
{
    public function update(Panel $panel)
    {
        $panel->update([
            'name' => request('name'),
            'settings' => [
                'query' => request('query'),
            ],
        ]);

        return back();
    }

    public function destroy(Panel $panel)
    {
        $panel->delete();

        return back();
    }
}
