<?php

namespace App\Livewire\Ventas;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public function render()
    {
        return view('livewire.pages.ventas.create')->layout('layouts.app');
    }
}
