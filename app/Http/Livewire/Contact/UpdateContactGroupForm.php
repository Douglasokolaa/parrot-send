<?php

namespace App\Http\Livewire\Contact;

use App\Enums\ContactGroupStatus;
use App\Models\ContactGroup;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\Rule;
use Livewire\Component;

class UpdateContactGroupForm extends Component
{

    public ContactGroup $contactGroup;

    protected array $rules = [
        'contactGroup.name' => ['required', 'max:256'],
        'contactGroup.status' => ['required'],
    ];

    public function mount(ContactGroup $group): void
    {
        $this->rules['contactGroup.status'] = ['required', Rule::in(ContactGroupStatus::asValidationArray())];
        $this->contactGroup = $group;
    }

    public function UpdateGroup(): Redirector
    {

        $this->validate();
        $this->contactGroup->save();
        return redirect(route('contact-groups.index'));
    }

    public function render()
    {
        $statuses = ContactGroupStatus::cases();
        return view('livewire.contact.update-contact-group-form', compact('statuses'));
    }
}
