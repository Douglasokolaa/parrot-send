<?php

namespace App\Http\Controllers;

use App\Enums\PhonebookStatus;
use App\Models\Phonebook;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PhonebookController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate(['name' => 'required|min:3']);
        $phonebook = $request->user()->currentTeam->phonebooks()->create($data);
        return redirect()->route('phonebooks.show', $phonebook->id);
    }

    public function update(Phonebook $phonebook, Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'   => ['required', 'min:3'],
            'status' => ['required', Rule::in(PhonebookStatus::asValidationArray())],
        ]);
        $phonebook->update($data);
        return redirect()->route('phonebooks.show', $phonebook->id)->with('success', 'Phonebook updated');
    }

    public function destroy(Phonebook $phonebook): RedirectResponse
    {
        $phonebook->delete();
        return redirect()->route('phonebooks.index');
    }
}
