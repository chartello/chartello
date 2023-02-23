<?php

namespace Chartello\Database;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Facades\DB;

class Schema implements Arrayable, Jsonable
{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function toArray()
    {
        $query = "SELECT t.table_name AS `table`, c.column_name AS `column` 
FROM information_schema.tables t 
LEFT JOIN information_schema.columns c 
ON t.table_name = c.table_name 
WHERE t.table_schema = '{$this->name}'
AND c.table_schema = '{$this->name}'";

        $tables = collect(DB::select($query))
            ->groupBy('table')
            ->mapWithKeys(fn ($result, $table) => [$table => $result->pluck('column')->all()])
            ->all();

        return $tables;
    }

    public function toJson($options = 0): string
    {
        return json_encode($this->toArray());
    }

    public function __toString(): string
    {
        return $this->toJson();
    }
}
