<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Phonebook;
use Illuminate\Http\RedirectResponse;

class PhonebookContactController extends Controller
{
    public function store(ContactRequest $request, Phonebook $phonebook): RedirectResponse
    {
        $phonebook->contacts()->create([
            ...$request->validated(),
            'team_id' => $request->user()->current_team_id
        ]);
        return redirect()->route('phonebooks.show', $phonebook->id);
    }

    public function update(ContactRequest $request, Contact $contact): RedirectResponse
    {
        $contact->update($request->validated());
        return redirect()->route('phonebooks.show', $contact->phonebook_id);
    }

    public function destroy(Contact $contact): RedirectResponse
    {
        $contact->delete();
        return redirect()->route('phonebooks.show', $contact->phonebook_id);
    }
}
