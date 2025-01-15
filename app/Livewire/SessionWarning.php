<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Session;
use Livewire\Component;

class SessionWarning extends Component
{
    public $sessionLifetime;
    public $timeRemaining;

    public function mount()
    {
        $this->sessionLifetime = config('session.lifetime') * 60; 

        $this->timeRemaining = $this->sessionLifetime - (time() - Session::get('last_activity', time()));
    }

    public function render()
    {
        return view('livewire.session-warning');
    }
}
