<?php

namespace App\Http\Livewire\E2E;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class Home extends Component
{
    public $screens=["input_provider"=>["my_inputs"],"farmer"=>["inputs","market"],"trader"=>["demand","supply"],"buyer"=>["supply"]];
    public $screen;
    protected $listeners=['navigate'];
    public function mount(){
        if(Auth::user()){
            if(Auth::user()->profile->personas){
                $this->screen=$this->screens[Auth::user()->profile->personas][0];
            }
        }
    }
    public function navigate($screen){
        $this->screen=$screen;
    }
    public function render()
    {
        return view('livewire.e2-e.home')->layout('layouts.e2e');
    }
}
