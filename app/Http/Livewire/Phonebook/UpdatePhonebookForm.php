<?php

namespace App\Http\Livewire\Phonebook;

use App\Enums\PhoneBookStatus;
use App\Models\Phonebook;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\Rule;
use Livewire\Component;
use function redirect;
use function view;

class UpdatePhonebookForm extends Component
{

    public Phonebook $phonebook;

    protected array $rules = [
        'phonebook.name' => ['required', 'max:256'],
        'phonebook.status' => ['required'],
    ];

    public function mount(Phonebook $group): void
    {
        $this->rules['phonebook.status'] = ['required', Rule::in(PhoneBookStatus::asValidationArray())];
        $this->phonebook = $group;
    }

    public function update(): Redirector
    {

        $this->validate();
        $this->phonebook->save();
        return redirect(route('phonebooks.index'));
    }

    public function render()
    {
        $statuses = PhoneBookStatus::cases();
        return view('livewire.phonebook.update-form', compact('statuses'));
    }
}
