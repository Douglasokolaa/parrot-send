<?php /** @noinspection ReturnTypeCanBeDeclaredInspection */

namespace Tests\Feature;

use App\Http\Livewire\Sender\CreateSenderForm;
use App\Http\Livewire\Sender\ToggleSenderState;
use App\Http\Livewire\Sender\UpdateSenderForm;
use App\Models\Sender;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire;
use Tests\TestCase;

class SenderTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateSender(): void
    {
        $this->withoutExceptionHandling();
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());
        $data = Sender::factory()->make();
        $response = Livewire::test(CreateSenderForm::class)
            ->set('name', $data->name)
            ->call('save');

        $this->assertAuthenticated();
        $response->assertHasNoErrors();
        self::assertSame($data->name, Sender::query()->first()->name);
        self::assertCount(1, Sender::all());
        self::assertTrue($user->currentTeam->is(Sender::first()->team));
    }

    public function testUpdateSender(): void
    {
        $this->withoutExceptionHandling();
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());
        $sender = Sender::factory()->create();
        $response = Livewire::test(UpdateSenderForm::class, compact('sender'))
            ->set('sender.name', 'VoteYouth')
            ->set('sender.enabled', true)
            ->call('save');

        $this->assertAuthenticated();
        $response->assertHasNoErrors();
        $sender->refresh();

        self::assertSame('VoteYouth', $sender->name);
        self::assertTrue($sender->enabled);
    }

    public function testToggleSenderEnabled()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());
        $sender = Sender::factory()->create(['enabled' => false]);
        $response = Livewire::test(ToggleSenderState::class, compact('sender'))
            ->call('toggle');

        $this->assertAuthenticated();
        $response->assertHasNoErrors();
        self::assertTrue($sender->refresh()->enabled);
        self::assertTrue($sender->enabled);
    }

    public function testDeleteSender()
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());
        $sender = Sender::factory()->create(['team_id' => $user->currentTeam->id]);
        $response = $this->delete("/senders/$sender->id");

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
        self::assertCount(0, Sender::all());
        $this->assertAuthenticated();
        $this->expectException(ModelNotFoundException::class);
        $sender->refresh();
    }

    /**
     * @throws \Exception
     */
    public function testSenderListView()
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());
        Sender::factory(10)->create();
        Sender::factory(10)->create(['team_id' => $user->currentTeam->id]);

        $response = $this->get("/senders");

        $this->assertAuthenticated();
        $response->assertStatus(200);
        $response->assertViewIs('sender.index');
        $response->assertViewHas('senders');
        self::assertCount(10, $response->viewData('senders'));
    }
}
