<?php /** @noinspection ReturnTypeCanBeDeclaredInspection */

use App\Http\Livewire\Phonebook\CreatePhonebookForm;
use App\Http\Livewire\Phonebook\UpdatePhonebookForm;
use App\Models\Phonebook;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PhonebookTest extends TestCase
{
    use RefreshDatabase;

    public function testCreatePhonebook()
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        Livewire::test(CreatePhonebookForm::class)
            ->set('name', 'Phonebook')
            ->call('create');

        $team = $user->currentTeam;
        $this->assertCount(1, $team->phonebooks);
        $this->assertEquals('Phonebook', $team->phonebooks()->latest('id')->first()->name);
    }

    public function testUpdatePhonebook()
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $team = $user->currentTeam;
        $group = Phonebook::factory()->create([
            'team_id' => $team->id
        ]);

        Livewire::test(UpdatePhonebookForm::class, ['group' => $group])
            ->set('phonebook.name', 'Phonebook 2')
            ->set('phonebook.status', 1)
            ->call('update');

        $this->assertEquals('Phonebook 2', $team->phonebooks()->latest('id')->first()->name);
        $this->assertEquals(1, $team->phonebooks()->latest('id')->first()->status->value);
    }

    public function testViewListOfTeamPhonebook()
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());
        Phonebook::factory()->count(5)->create([
            'team_id' => $user->currentTeam->id
        ]);

        $response = $this->get('/phonebooks');

        $this->assertAuthenticatedAs($user);
        $response->assertOk();
        $response->assertViewIs('phonebook.index');
        $response->assertViewHas('phonebooks');
    }

    public function testViewCreatePhonebook()
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());
        $response = $this->get('/phonebooks/create');

        $this->assertAuthenticatedAs($user);
        $response->assertOk();
        $response->assertViewIs('phonebook.create');
    }

    public function testDeletePhonebook()
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());
        $group = Phonebook::factory()->create(['team_id' => $user->currentTeam]);

        $response = $this->delete("phonebooks/$group->id");
        $response->assertRedirect();
        self::assertCount(0, Phonebook::all());
    }
}
