<?php

namespace Chartello\Lite\Models;

use Chartello\Lite\Database\Factories\DashboardFactory;

class Dashboard extends Model
{
    protected $table = 'chartello_dashboards';

    public function panels()
    {
        return $this->hasMany(Panel::class);
    }

    protected static function newFactory()
    {
        return new DashboardFactory();
    }
}
