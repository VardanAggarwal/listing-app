<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Resiliency;
use Illuminate\Support\Facades\Auth;
class CardInterests extends Component
{
    public $interests;
    public $type;
    public $model;

    public function toggleInterest(){
        if(Auth::user()){
            Auth::user()->profile->interest_resiliencies()->toggle([$this->model->id]);
        }
        else{
            return redirect()->guest('login')->with('status', 'Please login to perform this action');
        }
    }
    public function render()
    {
        $this->model->loadCount('interested_profiles');
        return view('livewire.card-interests');
    }
}
