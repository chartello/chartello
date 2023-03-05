<?php

namespace Chartello\Database\Factories;

use Chartello\Models\Panel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Chartello\Models\Panel>
 */
class PanelFactory extends Factory
{
    protected $model = Panel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => ucwords($this->faker->word),
            'settings' => [
                'query' => file_get_contents(__DIR__.'/../examples/trend-chart.sql'),
            ],
        ];
    }

    public function table()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'table',
                'settings' => [
                    'query' => file_get_contents(__DIR__.'/../examples/table.sql'),
                ],
            ];
        });
    }
}
