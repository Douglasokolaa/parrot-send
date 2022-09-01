<?php /** @noinspection ReturnTypeCanBeDeclaredInspection */

use App\Enums\PhonebookStatus;
use App\Models\Phonebook;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class PhonebookTest extends TestCase
{
    use RefreshDatabase;

    public function testCreatePhonebook()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());
        $response = $this->post('/phonebooks', Phonebook::factory()->raw(['name' => 'book 1']));

        $this->assertAuthenticated();
        $response->assertRedirect()->assertSessionHasNoErrors();
        $this->assertDatabaseHas('phonebooks', ['name' => 'book 1', 'team_id' => $user->current_team_id]);
    }

    public function testUpdatePhonebook()
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());
        $phonebook = Phonebook::factory()->create(['team_id' => $user->currentTeam->id]);
        $response = $this->put('/phonebooks/' . $phonebook->slug, ['name' => 'Updated Book', 'status' => PhonebookStatus::Active->value]);

        $this->assertAuthenticated();
        $response->assertRedirect()->assertSessionHasNoErrors();
        $this->assertDatabaseHas('phonebooks', ['name' => 'Updated Book', 'status' => PhonebookStatus::Active->value]);
    }

    public function testDeletePhonebook()
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());
        $group = Phonebook::factory()->create(['team_id' => $user->currentTeam]);

        $response = $this->delete("phonebooks/$group->slug");
        $response->assertRedirect();
        $this->assertDatabaseCount('phonebooks', 0);
    }

    public function testViewPhonebooksIndex()
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());
        Phonebook::factory()->create(['team_id' => $user->currentTeam]);

        $response = $this->get('/phonebooks');
        $this->assertAuthenticated();
        $response->assertOk()
                 ->assertInertia(fn(Assert $page) => $page
                     ->component('Phonebook/Index')
                     ->has('phonebooks')
                     ->has('canCreatePhonebook')
                 );
    }
}
