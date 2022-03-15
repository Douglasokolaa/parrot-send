<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\Phonebook;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PhonebookContactTest extends TestCase
{
    use RefreshDatabase;


    public function testListPhonebookContacts(): void
    {
        $this->withoutExceptionHandling();
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $phonebook = Phonebook::factory()->create(['team_id' => $user->currentTeam->id]);
        Contact::factory()->count(5);
        Contact::factory()->count(5)->create(['team_id' => $user->currentTeam, 'phonebook_id' => $phonebook->id]);
        $response = $this->get("/phonebooks/$phonebook->id/contacts");

        $this->assertAuthenticatedAs($user);
        $response->assertOk();
        $response->assertViewIs('phonebook.contacts');
        $response->assertViewHas('contacts', $phonebook->contacts()->paginate());
        $response->assertSee('Contacts');
    }
}
