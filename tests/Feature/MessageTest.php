<?php /** @noinspection PhpMissingReturnTypeInspection, ReturnTypeCanBeDeclaredInspection */

namespace Tests\Feature;

use App\Enums\MessageStatus;
use App\Models\Message;
use App\Models\Sender;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MessageTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSendDirectMessage()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->withPersonalTeam()->create();
        $sender = Sender::factory()->create(['team_id' => $user->currentTeam->id]);
        $sendAt = now()->toDateTimeString();
        Carbon::setTestNow($sendAt);

        $this->actingAs($user);
        $response = $this->post('/messages/direct', [
            'sender_id' => $sender->id,
            'country_code' => 'NG',
            'numbers' => "{$this->faker->numerify('0703#######')},{$this->faker->numerify('0703#######')}",
            'message' => 'Hello',
            'send_date' => $sendAt,
        ]);
        $this->assertAuthenticatedAs($user);
        $response->assertSessionHasNoErrors()->assertRedirect();

        $this->assertDatabaseCount('messages', 2);
        $this->assertDatabaseHas('messages', [
            'team_id' => $user->current_team_id,
            'sender_id' => $sender->id,
            'status' => MessageStatus::scheduled,
        ]);
    }
}
