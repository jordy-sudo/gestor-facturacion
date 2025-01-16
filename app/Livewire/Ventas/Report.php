<?php

namespace App\Livewire\Ventas;

use Livewire\Component;

class Report extends Component
{
    public function render()
    {
        return view('livewire.pages.ventas.report')->layout('layouts.app');
    }
}
