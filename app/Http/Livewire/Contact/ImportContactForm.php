<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace App\Http\Livewire\Contact;

use App\Imports\ContactsImport;
use App\Models\ContactGroup;
use Excel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Redirector;
use Livewire\Component;
use Livewire\WithFileUploads;
use function auth;
use function redirect;
use function view;

class ImportContactForm extends Component
{
    use WithFileUploads;

    public $contact_group;

    /** @var UploadedFile */
    public $file;

    public function rules(): array
    {
        return [
            'contact_group' => ['nullable', 'exists:contact_groups,id'],
            'file'          => ['required', 'file:csv,xlsx,txt,xml']
        ];
    }

    public function import(): Redirector|RedirectResponse
    {
        $this->validate();

        $team = auth()->user()->currentTeam;
        Excel::import(new ContactsImport($team, $this->contact_group), $this->file);
        return redirect()->route('contacts.index')->with('success', 'Uploaded');
    }

    public function render(): Factory|View|Application
    {
        $groups = ContactGroup::pluck('name', 'id');
        return view('livewire.contact.import-contact-form', compact('groups'));
    }
}
