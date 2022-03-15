<?php

namespace App\Http\Livewire\Contact;

use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\Rule;
use Livewire\Component;

class UpdateContactForm extends Component
{
    public Contact $contact;

    public function mount(Contact $contact): void
    {
        $this->contact = $contact;
    }

    public function rules(): array
    {
        return [
            'contact.first_name'    => ['required', 'max:256'],
            'contact.last_name'     => ['required', 'max:256'],
            'contact.phone_country' => ['required', 'string', 'max:2'],
            'contact.phone'         => ['required', Rule::phone()->countryField('phone_country')->detect()],
            'contact.email'         => ['present', 'nullable', 'email', 'max:256'],
            'contact.address'       => ['present', 'nullable', 'string', 'max:256'],
            'contact.city'          => ['present', 'nullable', 'string', 'max:256'],
            'contact.unit'          => ['present', 'nullable', 'string', 'max:256'],
            'contact.lga'           => ['present', 'nullable', 'string', 'max:256'],
            'contact.state'         => ['present', 'nullable', 'string', 'max:256'],
            'contact.region'        => ['present', 'nullable', 'string', 'max:256'],
            'contact.country'       => ['present', 'nullable', 'string', 'max:256'],
            'contact.business'      => ['present', 'nullable', 'string', 'max:256'],
        ];
    }

    public function update(): Redirector | RedirectResponse
    {
        $validated = $this->validate();
        $this->contact->update($validated);
        return redirect()->route('phonebooks.index')->with('success', 'Contact Updated');
    }

    public function render()
    {
        return view('livewire.contact.update-contact-form');
    }
}
