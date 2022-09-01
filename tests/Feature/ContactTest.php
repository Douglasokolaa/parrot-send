<?php /** @noinspection ReturnTypeCanBeDeclaredInspection */

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\Phonebook;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Storage;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateContact()
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());
        $phonebook = Phonebook::factory()->create(['team_id' => $user->currentTeam->id]);

        $this->assertDatabaseCount('contacts', 0);
        $response = $this->post("phonebooks/$phonebook->slug/contacts", Contact::factory()->raw([
            'phone'         => '08130000000',
            'phone_country' => 'NG'
        ]));

        $this->assertAuthenticatedAs($user);
        $response->assertSessionHasNoErrors()->assertRedirect();
        $this->assertDatabaseCount('contacts', 1);
        $this->assertEquals('08130000000', Contact::latest('id')->first()->phone);
        self::assertTrue($phonebook->is(Contact::latest('id')->first()->phonebook));
    }

    public function testUpdateContact()
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());
        $contact = Contact::factory()->create();
        $response = $this->put("contacts/$contact->id", [
            ...$contact->toArray(),
            'phone'         => '08130000000',
            'phone_country' => 'NG',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertSessionHasNoErrors()->assertRedirect();
        $contact->refresh();
        $this->assertEquals('08130000000', $contact->phone);
        $this->assertEquals('NG', $contact->phone_country);
    }

    public function testDeleteContact()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());
        $contact = Contact::factory()->create(['team_id' => $user->currentTeam]);

        $this->assertDatabaseCount('contacts', 1);
        $response = $this->delete("/contacts/$contact->id");

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect();
        $this->assertDatabaseCount('contacts', 0);
    }

    public function testImportContacts()
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());
        $phonebook = Phonebook::factory()->create(['team_id' => $user->currentTeam]);
        $content = Storage::drive('test')->get('contacts.csv');
        $file = UploadedFile::fake()->createWithContent('test.csv', $content);

        $this->assertDatabaseCount('contacts', 0);
        $response = $this->post("/phonebooks/$phonebook->slug/import", ['file' => $file]);

        $this->assertAuthenticatedAs($user);
        $response->assertSessionHasNoErrors()->assertRedirect();
        $this->assertCount(3, $user->currentTeam->contacts);
        $this->assertCount(3, $phonebook->contacts);
        $this->assertDatabaseCount('contacts', 3);
    }
}
