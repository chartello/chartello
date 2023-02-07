<?php

namespace Chartello\Lite\Database\Factories;

use Chartello\Lite\Models\Dashboard;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Chartello\Lite\Models\Dashboard>
 */
class DashboardFactory extends Factory
{
    protected $model = Dashboard::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => ucwords($this->faker->word),
        ];
    }
}
