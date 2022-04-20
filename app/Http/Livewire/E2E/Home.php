<?php

namespace App\Http\Livewire\E2E;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class Home extends Component
{
    public $role;
    public $action;
    protected $listeners=['navigate'];
    public function mount(){
        if(Auth::user()){
            if(Auth::user()->profile->personas){
                $this->role=Auth::user()->profile->personas;
            }
        }
        if($this->role=="farmer" || $this->role=="buyer"){
            $this->action="buy";
        }else{
            $this->action="sell";
        }
    }
    public function navigate($action){
        $this->action=$action;
    }
    public function render()
    {
        return view('livewire.e2-e.home')->layout('layouts.e2e');
    }
}
