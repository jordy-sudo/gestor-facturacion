<?php

namespace App\Livewire\Ventas;

use Livewire\Component;

class Override extends Component
{
    public function render()
    {
        return view('livewire.pages.ventas.override')->layout('layouts.app');
    }
}
