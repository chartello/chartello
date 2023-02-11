<?php

namespace Tests\Feature;

use Tests\TestCase;

class DashboardTest extends TestCase
{
    /** @test */
    public function it_works_in_local_environment()
    {
        app()->detectEnvironment(fn () => 'local');

        $response = $this->get('chartello');

        $response->assertRedirect('chartello/dashboards/1');
    }

    /** @test */
    public function it_cant_be_accessed_in_production_by_default()
    {
        app()->detectEnvironment(fn () => 'production');

        $response = $this->get('chartello');

        $response->assertStatus(404);
    }
}
