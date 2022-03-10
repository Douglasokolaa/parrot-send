<?php

namespace App\Http\Livewire\Sender;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use function auth;
use function view;

class CreateSenderForm extends Component
{
    public $name;

    protected $rules = ['name' => ['required', 'alpha_num', 'max:11']];

    public function save(): void
    {
        $this->validate();
        $team = auth()->user()->currentTeam;
        $team->senders()->create(['name' => $this->name]);
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.sender.create-sender-form');
    }
}
