<?php

/** @noinspection ReturnTypeCanBeDeclaredInspection */

namespace Tests\Feature;

use App\Models\Sender;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SenderTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateSender(): void
    {
        $this->withoutExceptionHandling();
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());
        $response = $this->post('senders', Sender::factory()->raw(['team_id' => $user->currentTeam->id]));

        $this->assertAuthenticated();
        $response->assertSessionHasNoErrors()->assertRedirect();
        $this->assertDatabaseHas('senders', ['team_id' => $user->currentTeam->id]);
        $this->assertDatabaseCount('senders', 1);
    }

    public function testUpdateSender(): void
    {
        $this->withoutExceptionHandling();
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());
        $sender = Sender::factory()->create(['team_id' => $user->currentTeam->id]);
        $response = $this->put("senders/$sender->id", ['name' => 'sandbox', 'enabled' => 1]);

        $this->assertAuthenticated();
        $response->assertSessionHasNoErrors()->assertRedirect();
        $this->assertDatabaseHas('senders', ['name' => 'sandbox', 'team_id' => $user->currentTeam->id, 'enabled' => true]);
    }

    public function testDeleteSender()
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());
        $sender = Sender::factory()->create(['team_id' => $user->currentTeam->id]);

        $this->assertDatabaseCount('senders', 1);
        $response = $this->delete("/senders/$sender->id");

        $response->assertRedirect();
        $this->assertDatabaseCount('senders', 0);
    }
}
