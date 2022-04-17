<?php

namespace App\Http\Livewire\E2E;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class BottomNav extends Component
{
    public $nav_actions=["input_provider"=>[], "farmer"=>["inputs","market"], "trader"=>["demand","supply"], "buyer"=>[]];
    public $icons=["inputs"=>"seedling","market"=>"money-bill-wave","demand"=>"building-wheat","supply"=>"truck"];
    public $nav_items=[];
    public function mount(){
        if(Auth::user()){
            if(Auth::user()->profile->personas){
                $this->nav_items=$this->nav_actions[Auth::user()->profile->personas];
            }
        }
    }
    public function navigate($nav){
        $this->emit('navigate',$screen=$nav);
    }
    public function render()
    {
        return view('livewire.e2-e.bottom-nav');
    }
}
