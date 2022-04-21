<?php

namespace App\Http\Livewire\E2E;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class Actions extends Component
{
    public $actions=["input_provider"=>["sell"=>"input"], "farmer"=>["buy"=>"input","sell"=>"produce"], "trader"=>["buy"=>"produce","sell"=>"produce"], "buyer"=>["buy"=>"produce"]];
    public $user_actions=[];
    public $role;
    public $allowed=false;
    public function mount(){
        if(Auth::user()){
            $profile=Auth::user()->profile;
            if($profile->personas){
                $this->user_actions=$this->actions[$profile->personas];
                $this->role=$profile->personas;
            }
            if($profile->name&&$profile->pincode){
                $this->allowed=true;
            }
        }
    }
    public function render()
    {
        return view('livewire.e2-e.actions')->layout('layouts.e2e');
    }
}
