<?php

use App\Http\Livewire\Contact\CreateContactGroupForm;
use App\Http\Livewire\Contact\UpdateContactGroupForm;
use App\Models\ContactGroup;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class testContactGroups extends TestCase
{
    use RefreshDatabase;

    public function testCreateContactGroup()
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        Livewire::test(CreateContactGroupForm::class)
            ->set('name', 'Test group')
            ->call('createGroup');

        $team = $user->currentTeam;
        $this->assertCount(1, $team->contactGroups);
        $this->assertEquals('Test group', $team->contactGroups()->latest('id')->first()->name);
    }

    public function testUpdateContactGroup(): void
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $team = $user->currentTeam;
        $group = ContactGroup::factory()->create([
            'team_id' => $team->id
        ]);

        Livewire::test(UpdateContactGroupForm::class, ['group' => $group])
            ->set('contactGroup.name', 'Test group 2')
            ->set('contactGroup.status', 1)
            ->call('UpdateGroup');

        $this->assertEquals('Test group 2', $team->contactGroups()->latest('id')->first()->name);
        $this->assertEquals(1, $team->contactGroups()->latest('id')->first()->status->value);
    }
}
