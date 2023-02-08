<?php

namespace Chartello\Models;

use Chartello\Database\Factories\DashboardFactory;

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
