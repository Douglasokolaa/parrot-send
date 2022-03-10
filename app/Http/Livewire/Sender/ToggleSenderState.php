<?php

namespace App\Http\Livewire\Sender;

use App\Models\Sender;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ToggleSenderState extends Component
{
    public Sender $sender;

    public function mount(Sender $sender): void
    {
        $this->sender = $sender;
    }
    public function toggle(): void
    {
        $this->sender->enabled  = !$this->sender->enabled;
        $this->sender->save();
    }
    public function render(): Factory|View|Application
    {
        return view('livewire.sender.toggle-sender-state');
    }
}
