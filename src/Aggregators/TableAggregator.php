<?php

namespace Chartello\Aggregators;

use Illuminate\Support\Facades\DB;

class TableAggregator extends BaseAggregator
{
    public function get()
    {
        DB::statement(DB::raw("SET @start := '{$this->start}'"));
        DB::statement(DB::raw("SET @end := '{$this->end}'"));

        return DB::select($this->query);
    }
}
