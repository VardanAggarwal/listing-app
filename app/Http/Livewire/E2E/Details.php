<?php

namespace App\Http\Livewire\E2E;

use Livewire\Component;

class Details extends Component
{
    public function render()
    {
        return view('livewire.e2-e.details')->layout('layouts.e2e');
    }
}
