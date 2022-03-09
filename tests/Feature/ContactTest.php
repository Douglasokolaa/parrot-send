<?php /** @noinspection ReturnTypeCanBeDeclaredInspection */

namespace Tests\Feature;

use App\Http\Livewire\Contact\CreateContactForm;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateContactView()
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());
        $response = $this->get('/contacts/create');

        $this->assertAuthenticatedAs($user);
        $response->assertOk();
        $response->assertSee('Add Contact');
        $response->assertViewIs('contact.create');
    }

    public function testCreateContact()
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $response = Livewire::test(CreateContactForm::class)
            ->set('first_name', 'John')
            ->set('last_name', 'Doe')
            ->set('phone', '08130000000')
            ->set('phone_country', 'NG')
            ->set('city', 'city')
            ->set('unit', 'Polling Unit')
            ->set('lga', 'lga')
            ->set('state', 'state')
            ->set('region', 'region')
            ->set('country', 'country')
            ->set('business', 'business')
            ->set('email', 'email@example.com')
            ->call('saveContact');

        $this->assertAuthenticatedAs($user);
        $response->assertHasNoErrors();
        $response->assertRedirect();
        $this->assertCount(1, Contact::all());
        $this->assertEquals('John', Contact::latest('id')->first()->first_name);
        $this->assertEquals('08130000000', Contact::latest('id')->first()->phone_normalized);
        self::assertTrue($user->currentTeam->is(Contact::latest('id')->first()->team));
    }
}
