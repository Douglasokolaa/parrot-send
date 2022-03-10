<?php

namespace App\Http\Controllers;

use App\Models\Sender;
use Illuminate\Http\RedirectResponse;

class SenderController extends Controller
{
    public function index()
    {
        $senders = auth()->user()->currentTeam->senders()->paginate();
        return view('sender.index', compact('senders'));
    }

    public function destroy(Sender $sender): RedirectResponse
    {
        abort_unless($sender->team->is(auth()->user()->currentTeam), 404);
        $sender->delete();
        return redirect()->route('senders.index')->with('success', 'Sender Deleted');
    }
}
