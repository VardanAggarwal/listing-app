<?php

namespace App\Http\Livewire\E2E;

use Livewire\Component;

class Trades extends Component
{
    public function render()
    {
        return view('livewire.e2-e.trades')->layout('layouts.e2e');
    }
}
