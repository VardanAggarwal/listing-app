<?php

namespace App\Http\Livewire\E2E;

use Livewire\Component;

class Contact extends Component
{
    public $href;
    public $call;
    public function render()
    {
        return view('livewire.e2-e.contact');
    }
}
