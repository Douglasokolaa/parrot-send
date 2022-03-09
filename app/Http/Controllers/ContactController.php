<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = auth()->user()->currentTeam->contacts()->paginate();
        return view('contact.index', compact('contacts'));
    }

    public function create()
    {
        return view('contact.create');
    }

    public function edit(Contact $contact)
    {
        return view('contact.edit', compact('contact'));
    }

    public function destroy(Contact $contact): RedirectResponse
    {
        abort_unless($contact->team->is(auth()->user()->currentTeam), 404);

        $contact->delete();
        return back()->with('success', 'Contact Deleted');
    }
}
