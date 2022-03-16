<?php

namespace App\Http\Livewire\Leads;

use Livewire\Component;

class Card extends Component
{
    public $index=0;
    public function render()
    {
        return view('livewire.leads.card');
    }
}
