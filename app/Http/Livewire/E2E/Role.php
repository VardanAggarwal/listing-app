<?php

namespace App\Http\Livewire\E2E;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Role extends Component
{
    public $roles=["production_support", "producer", "trader", "processor", "buyer"];
    public $role_string='';
    public $selected=[];
    public function mount(){
        if(Auth::user()){
            if(Auth::user()->profile->personas){
                $this->selected=explode(", ", Auth::user()->profile->personas);
            }
        }
        $role_string="";
        foreach ($this->selected as $value) {
            $role_string.=__('e2e.roles.'.$value.'.label').', ';
        }
        $this->role_string=rtrim($role_string,", ");
    }
    public function submit(){
        $role_string="";
        foreach ($this->selected as $value) {
            $role_string.=$value.', ';
        }
        $role_string=rtrim($role_string,", ");
        $profile=Auth::user()->profile;
        $profile->personas=$role_string;
        $profile->save();
        return redirect('/e2e/details');                
    }
    public function set_string(){
        $role_string="";
        foreach ($this->selected as $value) {
            $role_string.=__('e2e.roles.'.$value.'.label').', ';
        }
        $this->role_string=rtrim($role_string,", ");
    }
    public function render()
    {
        return view('livewire.e2-e.role')->layout('layouts.e2e');
    }
}
