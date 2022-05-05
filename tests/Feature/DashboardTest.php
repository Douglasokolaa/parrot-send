<?php /** @noinspection ReturnTypeCanBeDeclaredInspection */

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardTest extends \Tests\TestCase
{
    use RefreshDatabase;

    public function testCanViewDashboard()
    {
        $this->actingAs(User::factory()->create())
             ->get(route('dashboard'))
             ->assertOk();
    }

}
