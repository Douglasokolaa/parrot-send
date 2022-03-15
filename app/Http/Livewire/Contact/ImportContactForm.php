<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace App\Http\Livewire\Contact;

use App\Imports\ContactsImport;
use App\Models\Phonebook;
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

    public $phonebook;

    /** @var UploadedFile */
    public $file;

    public function rules(): array
    {
        return [
            'phonebook' => ['nullable', 'exists:phonebooks,id'],
            'file'      => ['required', 'file:csv,xlsx,txt,xml']
        ];
    }

    public function import(): Redirector|RedirectResponse
    {
        $this->validate();

        $team = auth()->user()->currentTeam;
        Excel::import(new ContactsImport($team, $this->phonebook), $this->file);
        return redirect()->route('phonebooks.contacts.index', $this->phonebook)->with('success', 'Uploaded');
    }

    public function render(): Factory|View|Application
    {
        $groups = Phonebook::pluck('name', 'id');
        return view('livewire.contact.import-contact-form', compact('groups'));
    }
}
