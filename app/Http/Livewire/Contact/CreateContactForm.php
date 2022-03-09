<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace App\Http\Livewire\Contact;

use App\Models\Contact;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CreateContactForm extends Component
{

    public $first_name;
    public $last_name;
    public $email;
    public $address;
    public $city;
    public $unit;
    public $lga;
    public $state;
    public $region;
    public $country;
    public $business;
    public $phone;
    public $phone_country;

    public function rules(): array
    {
        return [
            'first_name'    => ['required', 'max:256'],
            'last_name'     => ['required', 'max:256'],
            'phone_country' => ['required', 'string', 'max:2'],
            'phone'         => ['required', Rule::phone()->countryField('phone_country')->detect()],
            'email'         => ['present', 'nullable', 'email', 'max:256'],
            'address'       => ['present', 'nullable', 'string', 'max:256'],
            'city'          => ['present', 'nullable', 'string', 'max:256'],
            'unit'          => ['present', 'nullable', 'string', 'max:256'],
            'lga'           => ['present', 'nullable', 'string', 'max:256'],
            'state'         => ['present', 'nullable', 'string', 'max:256'],
            'region'        => ['present', 'nullable', 'string', 'max:256'],
            'country'       => ['present', 'nullable', 'string', 'max:256'],
            'business'      => ['present', 'nullable', 'string', 'max:256'],
        ];
    }

    public function saveContact(): Redirector
    {
        $validated = $this->validate();
        $team = auth()->user()->currentTeam;
        $team->contacts()->create($validated);
        return redirect(route('contacts.index'));
    }

    public function render()
    {
        return view('livewire.contact.create-contact-form');
    }
}
