<?php

namespace Chartello\Aggregators;

abstract class BaseAggregator implements Aggregator
{
    public function __construct(string $query, string $start, string $end)
    {
        $this->query = $query;
        $this->start = $start;
        $this->end = $end;
    }
}
