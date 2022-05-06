<?php

namespace App\Http\Controllers;

use App\Imports\ContactsImport;
use App\Models\Phonebook;
use Illuminate\Http\Request;

class PhonebookImportController extends Controller
{
    public function __invoke(Request $request, Phonebook $phonebook)
    {
        $request->validate([
            'phonebook' => ['nullable', 'exists:phonebooks,id'],
            'file'      => ['required', 'file:csv,xlsx']
        ]);
        \Excel::import(new ContactsImport($request->user()->currentTeam, $phonebook), $request->file('file'));
        return redirect()->route('phonebooks.show', $phonebook->id);
    }
}
