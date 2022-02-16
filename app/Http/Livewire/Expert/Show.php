<?php

namespace App\Http\Livewire\Expert;

use Livewire\Component;

class Show extends Component
{
    public $profile;
    public function render()
    {
        return view('livewire.expert.show');
    }
}
