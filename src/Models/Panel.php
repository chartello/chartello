<?php

namespace Chartello\Lite\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;

class Panel extends Model
{
    protected $table = 'chartello_panels';

    protected $casts = [
        'settings' => 'array',
    ];

    protected $appends = ['aggregate'];

    protected function aggregate(): Attribute
    {
        return Attribute::make(
            get: fn($value) => collect($this->data)->sum('y'),
        );
    }
}
