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
                'query' => 'SELECT COUNT(*) AS y,
DATE(created_at) AS x
FROM users
WHERE created_at BETWEEN @start AND @end
GROUP BY x
ORDER BY x ASC',
            ],
        ];
    }

    public function table()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'table',
                'settings' => [
                    'query' => 'SELECT id, name, email, created_at
FROM users
WHERE created_at BETWEEN @start AND @end
ORDER BY created_at ASC',
                ],
            ];
        });
    }
}
