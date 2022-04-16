<?php

namespace App\Http\Livewire\E2E;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class Actions extends Component
{
    public $actions=["input_provider"=>["sell_input"], "farmer"=>["buy_input","sell_produce"], "trader"=>["buy_from_farmer","sell_to_buyer"], "buyer"=>["buy_material"]];
    public $user_actions=[];
    public function mount(){
        if(Auth::user()){
            if(Auth::user()->profile->personas){
                $this->user_actions=$this->actions[Auth::user()->profile->personas];
            }
        }
    }
    public function render()
    {
        return view('livewire.e2-e.actions')->layout('layouts.e2e');
    }
}
