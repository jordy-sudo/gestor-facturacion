<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Users extends Component
{
    public function render()
    {
        return view('livewire.pages.admin.users')->layout('layouts.app');
    }
}
