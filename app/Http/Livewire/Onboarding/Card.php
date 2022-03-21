<?php

namespace App\Http\Livewire\Onboarding;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class Card extends Component
{
    public $index=0;
    public $show=true;
    public function mount(){
        if(Auth::user()){
            if(Auth::user()->profile){
                if(isset(Auth::user()->profile->additional_info["onboarding"]))
                    $this->show=false;
            }
        }
    }
    public function render()
    {
        return view('livewire.onboarding.card');
    }
}
