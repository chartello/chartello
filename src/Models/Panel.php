<?php

namespace Chartello\Models;

use Chartello\Aggregators\TableAggregator;
use Chartello\Aggregators\TrendAggregator;
use Chartello\Database\Factories\PanelFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Throwable;

class Panel extends Model
{
    protected $table = 'chartello_panels';

    protected static $aggregatorTypes = [
        'trend-chart' => TrendAggregator::class,
        'table' => TableAggregator::class,
    ];

    protected $casts = [
        'settings' => 'array',
    ];

    protected $appends = ['aggregate'];

    protected function aggregate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => collect($this->data)->sum('y'),
        );
    }

    public function populate($start, $end)
    {
        $query = data_get($this, 'settings.query');

        if (! $query) {
            $this->data = [];

            return;
        }

        $aggregator = $this->newAggregator($query, $start, $end);

        try {
            $this->data = $aggregator->get();
        } catch (Throwable $exception) {
            $this->data = [];
            $this->error = $exception->getMessage();
        }
    }

    protected function newAggregator($query, $start, $end)
    {
        $type = static::$aggregatorTypes[$this->type] ?? reset(static::$aggregatorTypes);

        return new $type($query, $start, $end);
    }

    protected static function newFactory()
    {
        return new PanelFactory();
    }
}
