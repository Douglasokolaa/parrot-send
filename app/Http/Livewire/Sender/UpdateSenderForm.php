<?php

namespace App\Http\Livewire\Sender;

use App\Models\Sender;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Livewire\Component;
use function auth;
use function view;

class UpdateSenderForm extends Component
{
    public Sender $sender;

    public function mount(Sender $sender): void
    {
        $this->sender = $sender;
    }

    public function rules(): array
    {
        return [
            'sender.name'    => ['required',
                Rule::unique('senders', 'name')
                    ->ignore($this->sender->id)->where('team_id', auth()->user()->currentTeam)
            ],
            'sender.enabled' => ['required', 'bool'],
        ];
    }

    public function save(): void
    {
        $this->validate();
        $this->sender->save();
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.sender.update-sender-form');
    }
}
