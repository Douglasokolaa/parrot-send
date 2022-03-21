<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace App\Http\Livewire;

use App\Models\Sender;
use App\Rules\Delimited;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Livewire\Component;
use Propaganistas\LaravelPhone\Rules\Phone;

class SendDirectMessage extends Component
{
    public $sender_id;
    public $country_code;
    public $numbers;
    public $message;
    public $send_date;
    /** @var Sender[] */
    public $senders;

    public function rules(): array
    {
        return [
            'sender_id'    => ['required', 'exists:senders,id'],
            'country_code' => ['required', 'string'],
            'numbers'      => ['required', new Delimited((new Phone())->detect()->country($this->country_code))],
            'message'      => ['required', 'max:255'],
            'send_date'    => ['required', 'after_or_equal:now'],
        ];
    }

    public function send(): Redirector|RedirectResponse
    {
        $this->validate();
        $user = auth()->user();
        foreach (explode(',', $this->numbers) as $number) {
            $phone_e164 = \phone($number, $this->country_code)->formatE164();
            $user->currentTeam->messages()->create([
                'sender_id'    => $this->sender_id,
                'receiver'        => $number,
                'phone_e164'   => $phone_e164,
                'message'      => $this->message,
                'scheduled_at' => $this->send_date,
                'sent_by'      => $user->id,
            ]);
        }
        return redirect('/');
    }

    public function render(): View
    {
        return view('livewire.send-direct-message');
    }
}
