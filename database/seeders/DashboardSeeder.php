<?php

namespace Database\Seeders;

use App\Models\Dashboard;
use Illuminate\Database\Seeder;

class DashboardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $overview = Dashboard::create(['name' => 'Overview']);

        $overview->panels()->create([
            'name' => 'Users',
            'settings' => [
                'query' => 'SELECT COUNT(*) AS y,
DATE(created_at) AS x
FROM users
WHERE created_at BETWEEN @start AND @end
GROUP BY x
ORDER BY x ASC',
            ],
        ]);
    }
}
