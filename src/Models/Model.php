<?php

namespace Chartello\Lite\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;

abstract class Model extends Eloquent
{
    use HasFactory;

    protected $guarded = [];
}
