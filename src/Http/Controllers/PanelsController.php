<?php

namespace Chartello\Http\Controllers;

use Chartello\Models\Panel;

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
