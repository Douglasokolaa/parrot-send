<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class testDashboard extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->actingAs(User::factory()->withPersonalTeam()->create());
        $response = $this->get('/dashboard');

        $response->assertStatus(200)
        ->assertSee('Dashboard');
    }
}
