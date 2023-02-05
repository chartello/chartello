<?php

namespace Chartello\Lite\Models;

class Dashboard extends Model
{
    protected $table = 'chartello_dashboards';

    public function panels()
    {
        return $this->hasMany(Panel::class);
    }
}
