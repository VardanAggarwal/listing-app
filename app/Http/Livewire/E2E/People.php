<?php

namespace App\Http\Livewire\E2E;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models;
class People extends Component
{
    public $resiliencies;
    public $selected_resiliency;
    public function mount(){
        if(Auth::user()){
            if(isset(Auth::user()->profile->interest_resiliencies)){
                $this->resiliencies=Auth::user()->profile->interest_resiliencies->unique();
            }
            $this->selected_resiliency=$this->resiliencies->first();
        }
    }
    public function select($item){
        $this->selected_resiliency=Models\Resiliency::find($item);
    }
    public function render()
    {
        return view('livewire.e2-e.people');
    }
}
