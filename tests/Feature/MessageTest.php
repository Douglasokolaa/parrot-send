<?php /** @noinspection ReturnTypeCanBeDeclaredInspection */

namespace Tests\Feature;

use App\Http\Livewire\SendDirectMessage;
use App\Models\Message;
use App\Models\Sender;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire;
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
        $team = $user->currentTeam;
        $senders = Sender::factory()->count(1)->create(['team_id' => $team->id]);

        $sendAt = now()->toDateTimeString();
        Carbon::setTestNow($sendAt);

        $this->actingAs($user);
        $response = Livewire::test(SendDirectMessage::class, ['senders' => $senders])
            ->set('sender_id', $senders->first()->id)
            ->set('country_code', 'NG')
            ->set('numbers', "{$this->faker->numerify('0703#######')},{$this->faker->numerify('0703#######')}")
            ->set('message', 'Hello World')
            ->set('send_date', $sendAt)
            ->call('send');

        $this->assertAuthenticatedAs($user);
        $response->assertHasNoErrors();
        $response->assertRedirect();

        self::assertCount(2, $team->messages);
        self::assertTrue($senders->first()->is($team->messages->first()->sender));
        self::assertTrue($team->is(Message::first()->team));

        $mem = $team->messages[0]->toArray();
        self::assertArrayHasKey('receiver', $mem);
        self::assertArrayHasKey('status', $mem);
        self::assertArrayHasKey('channel_id', $mem);
        self::assertArrayHasKey('response', $mem);
    }
}
