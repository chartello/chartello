<?php

namespace Chartello\Aggregators;

use Illuminate\Support\Facades\DB;

class TableAggregator extends BaseAggregator
{
    public function get()
    {
        DB::statement(DB::raw("SET @start = '{$this->start}'")->getValue(DB::connection()->getQueryGrammar()));
        DB::statement(DB::raw("SET @end = '{$this->end}'")->getValue(DB::connection()->getQueryGrammar()));

        return DB::select($this->query);
    }
}
