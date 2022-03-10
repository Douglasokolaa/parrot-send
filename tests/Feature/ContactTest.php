<?php
/** @noinspection PhpUnhandledExceptionInspection */
/** @noinspection ReturnTypeCanBeDeclaredInspection */

namespace Tests\Feature;

use App\Http\Livewire\Contact\CreateContactForm;
use App\Http\Livewire\Contact\ImportContactForm;
use App\Http\Livewire\Contact\UpdateContactForm;
use App\Models\Contact;
use App\Models\ContactGroup;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Livewire;
use Storage;
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
        $this->assertEquals('08130000000', Contact::latest('id')->first()->phone);
        self::assertTrue($user->currentTeam->is(Contact::latest('id')->first()->team));
    }

    public function testEditContactView()
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());
        $contact = Contact::factory()->create();
        $response = $this->get("/contacts/$contact->id/edit");

        $this->assertAuthenticatedAs($user);
        $response->assertOk();
        $response->assertSee('Edit Contact');
        $response->assertViewIs('contact.edit');
        $response->assertViewHas('contact');
    }

    public function testUpdateContact()
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());
        $contact = Contact::factory()->create();
        $response = Livewire::test(UpdateContactForm::class, compact('contact'))
            ->set('contact.phone', '08130000000')
            ->set('contact.phone_country', 'NG')
            ->call('update');

        $response->assertHasNoErrors();
        $response->assertRedirect();
        $this->assertAuthenticatedAs($user);
        $this->assertEquals('08130000000', Contact::latest('id')->first()->phone);
        $this->assertEquals('NG', Contact::latest('id')->first()->phone_country);
    }

    public function testListContact()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());
        Contact::factory()->count(5);
        Contact::factory()->count(5)->create(['team_id' => $user->currentTeam]);
        $response = $this->get("/contacts");

        $this->assertAuthenticatedAs($user);
        $response->assertOk();
        $response->assertViewIs('contact.index');
        $response->assertViewHas('contacts', $user->currentTeam->contacts()->paginate());
        $response->assertSee('Contacts');
    }

    public function testDeleteContact()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());
        $contact = Contact::factory()->create(['team_id' => $user->currentTeam]);
        $response = $this->delete("/contacts/$contact->id");

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect();
        $response->assertSessionHas('success');
        self::assertCount(0, Contact::all());
    }

    public function testImportContacts()
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());
        $group = ContactGroup::factory()->create(['team_id' => $user->currentTeam]);
        $content = Storage::drive('test')->get('contacts.csv');
        $file = UploadedFile::fake()->createWithContent('test.csv', $content);

        $response = Livewire::test(ImportContactForm::class)
            ->set('contact_group', $group->id)
            ->set('file', $file)
            ->call('import');

        $response->assertHasNoErrors();
        $response->assertRedirect();
        $this->assertAuthenticatedAs($user);
        self::assertCount(3, $user->currentTeam->contacts);
    }
}
