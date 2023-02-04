<?php

namespace Chartello\Lite\Models;

class Dashboard extends Model
{
    public function panels()
    {
        return $this->hasMany(Panel::class);
    }
}
