<?php

namespace App\Http\Controllers;

use App\Http\Requests\DirectMessageRequest;
use Illuminate\Http\RedirectResponse;
use Parrot\Sms\SmsProvider;

use function phone;

class DirectMessageController extends Controller
{
    public function store(DirectMessageRequest $request, SmsProvider $provider): RedirectResponse
    {
        $data = $request->input();
        $user = $request->user();
        $team = $user->currentTeam;
        foreach ($data['numbers'] as $number) {
            $phone_e164 = phone($number, $data['country_code'])->formatE164();
            $team->messages()->create([
                'sender_id'    => $data['sender_id'],
                'receiver'     => $number,
                'phone_e164'   => $phone_e164,
                'message'      => $data['message'],
                'scheduled_at' => $data['send_date'],
                'sent_by'      => $user->id,
            ]);
        }
        return redirect()->route('dashboard')->with('success', 'Message sent');
    }
}
