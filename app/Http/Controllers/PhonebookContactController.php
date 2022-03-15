<?php

namespace App\Http\Controllers;

use App\Models\Phonebook;

class PhonebookContactController extends Controller
{
    public function index(Phonebook $phonebook)
    {
        return view('phonebook.contacts', ['contacts' => $phonebook->contacts()->paginate()]);
    }
}
