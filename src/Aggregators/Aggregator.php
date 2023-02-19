<?php

namespace Chartello\Aggregators;

interface Aggregator
{
    public function __construct(string $query, string $start, string $end);

    public function get();
}
