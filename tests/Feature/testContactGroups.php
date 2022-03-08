<?php

use App\Http\Livewire\Contact\CreateContactGroupForm;
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
}
