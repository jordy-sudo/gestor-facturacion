<?php

namespace App\Livewire\Ventas;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.pages.ventas.index')->layout('layouts.app');
    }
}
