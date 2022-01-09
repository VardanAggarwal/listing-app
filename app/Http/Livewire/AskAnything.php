<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AskAnything extends Component
{
    public $form=false;
    public $interest=[];
    public $others="";
    public function showForm(){
        $this->form=true;
    }
    public function render()
    {
        return view('livewire.ask-anything');
    }
}
