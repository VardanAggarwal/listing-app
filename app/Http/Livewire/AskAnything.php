<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AskAnything extends Component
{
    public $form=false;
    public $interest_recorded=false;
    public $interest=[];
    public $others="";
    public $selected=[];
    protected $listeners = ['updateSelected'];
    public function updateSelected($selected){
        $this->selected=$selected;
    }
    public function save_interest(){
        if(Auth::user()){
            Auth::user()->profile->interest_resiliencies()->attach($this->selected,[
                'interest'=>[
                    'interests'=>$this->interest,
                    'others'=>$this->others
                ]
            ]);
            $this->form=false;
            $this->interest_recorded=true;
            $this->interest=[];
            $this->others="";
            $this->selected=[];
        }else{
            return redirect()->guest('login')->with('status', 'Please login to perform this action');
        }
    }
    public function render()
    {
        return view('livewire.ask-anything');
    }
}
