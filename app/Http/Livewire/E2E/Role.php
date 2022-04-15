<?php

namespace App\Http\Livewire\E2E;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Role extends Component
{
    public $roles=["input_provider", "farmer", "trader", "buyer"];
    public $selected="";
    protected $queryString = [
        'selected'=>['except'=>'']
    ];
    public function mount(){
        if(Auth::user()){
            if(Auth::user()->profile->personas){
                $this->selected=Auth::user()->profile->personas;
            }
        }
    }
    public function submit($role){
        if(Auth::user()){
            $profile=Auth::user()->profile;
            $profile->personas=$role;
            $profile->save();
        }else{
            session()->put('role',$role);
        }
        return redirect('/e2e/login?role='.$role);                
    }
    public function render()
    {
        return view('livewire.e2-e.role')->layout('layouts.e2e');
    }
}
