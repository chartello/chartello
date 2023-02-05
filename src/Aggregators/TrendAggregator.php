<?php

namespace Chartello\Lite\Aggregators;

use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TrendAggregator
{
    public function __construct(string $query, string $start, string $end)
    {
        $this->query = $query;
        $this->start = $start;
        $this->end = $end;
    }

    public function get()
    {
        $output = [];

        DB::statement(DB::raw("SET @start := '{$this->start}'"));
        DB::statement(DB::raw("SET @end := '{$this->end}'"));
        $results = collect(DB::select($this->query));

        $this->validate($results);

        for ($i = new Carbon($this->start); $i->lt($this->end); $i->addDay()) {
            $date = $i->format('Y-m-d');
            $result = $results->first(fn ($result) => $result->x === $date);

            $output[] = [
                'x' => $date,
                'y' => $result ? $result->y : 0,
            ];
        }

        return $output;
    }

    protected function validate($data)
    {
        if (! $data->count()) {
            return;
        }

        if (! data_get($data->first(), 'x')) {
            throw new Exception('Could not find column x.');
        }

        if (! data_get($data->first(), 'y')) {
            throw new Exception('Could not find column y.');
        }
    }
}
