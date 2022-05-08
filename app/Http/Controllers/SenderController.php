<?php

namespace App\Http\Controllers;

use App\Models\Sender;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SenderController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'alpha_num', 'min:3', 'max:11']
        ]);
        $request->user()->currentTeam->senders()->create($data);
        return redirect()->route('senders.index')->with('success', __('Successfully requested Sender ID'));
    }

    public function update(Request $request, Sender $sender)
    {
        $data = $request->validate([
            'name'    => ['required', 'alpha_num', 'min:3', 'max:11'],
            'enabled' => ['required', 'boolean']
        ]);
        $sender->update($data);
        return redirect()->route('senders.index');
    }

    public function destroy(Sender $sender): RedirectResponse
    {
        $sender->delete();
        return redirect()->route('senders.index');
    }
}
