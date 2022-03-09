<?php

namespace App\Http\Livewire\Contact;

use Illuminate\Routing\Redirector;
use Livewire\Component;
use function view;

class CreateContactGroupForm extends Component
{
    public $name;

    protected array $rules = [
        'name' => ['required', 'max:256']
    ];

    public function createGroup(): Redirector
    {
        $this->validate();

        $team = auth()->user()->currentTeam;
        $team->contactGroups()->create([
            'name'    => $this->name,
            'team_id' => $team->id
        ]);

        return redirect(route('contact-groups.index'));
    }

    public function render()
    {
        return view('livewire.contact.create-contact-group-form');
    }
}
