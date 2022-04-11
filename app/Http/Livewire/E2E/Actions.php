<?php

namespace App\Http\Livewire\E2E;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class Actions extends Component
{
    public $actions=["production_support"=>["sell_input", "offer_training","offer_contract_farming","sell_rent_machinery"], "producer"=>["buy_input","get_training","do_contract_farming","buy_rent_machinery","sell_material","vc_discovery"], "trader"=>["buy_material","sell_material"], "processor"=>["buy_material","sell_material"], "buyer"=>["buy_material"]];
    public $user_actions=[];
    public function mount(){
        $roles=[];
        if(Auth::user()){
            if(Auth::user()->profile->personas){
                $roles=explode(", ", Auth::user()->profile->personas);
            }
        }
        foreach($roles as $role){
            $this->user_actions=array_merge($this->user_actions,$this->actions[$role]);
        }
        $this->user_actions=array_unique($this->user_actions);
    }
    public function render()
    {
        return view('livewire.e2-e.actions')->layout('layouts.e2e');
    }
}
