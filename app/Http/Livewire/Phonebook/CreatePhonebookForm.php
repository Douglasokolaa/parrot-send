<?php

namespace App\Http\Livewire\Phonebook;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Livewire\Component;
use function auth;
use function redirect;
use function view;

class CreatePhonebookForm extends Component
{
    public $name;

    protected array $rules = [
        'name' => ['required', 'max:256']
    ];

    public function create(): Redirector|RedirectResponse
    {
        $this->validate();

        $team = auth()->user()->currentTeam;
        $team->phonebooks()->create([
            'name'    => $this->name,
            'team_id' => $team->id
        ]);

        return redirect()->route('phonebooks.index');
    }

    public function render()
    {
        return view('livewire.phonebook.create-form');
    }
}
