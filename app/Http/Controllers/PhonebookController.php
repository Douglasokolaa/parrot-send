<?php

namespace App\Http\Controllers;

use App\Enums\PhonebookStatus;
use App\Models\Phonebook;
use App\Policies\TeamPolicy;
use App\ValueObject\Permissions;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class PhonebookController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Phonebook::class);
    }

    public function index(Request $request): Response
    {
        return Inertia::render('Phonebook/Index', [
            'canCreatePhonebook' => $request->user()->can('create', Phonebook::class),
            'phonebooks'         => Phonebook::query()->search($request->only(['search']))->withCount(['contacts',])->paginate()->withQueryString(),
        ]);
    }

    public function show(Phonebook $phonebook): Response
    {
        $phonebook->load('team');
        return Inertia::render('Phonebook/Show', [
            'contactPermissions' => new Permissions($phonebook, auth()->user()),
            'phonebook' => $phonebook,
            'contacts'=> $phonebook->contacts()->paginate(),
        ]);
    }

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
        return redirect()->back();
    }

    public function destroy(Phonebook $phonebook): RedirectResponse
    {
        Phonebook::all();
        \DB::transaction(function () use ($phonebook) {
            $phonebook->contacts()->delete();
            $phonebook->delete();
        });
        return redirect()->route('phonebooks.index');
    }
}
