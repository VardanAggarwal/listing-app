<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class CardInterests extends Component
{
    public $interest_recorded=false;
    public $type;
    public $model;
    public $interest=[];
    public $others="";
    protected $listeners = ['interest_updated' => '$refresh'];
    public function save_interest(){
        if(Auth::user()){
            $this->model->interested_profiles()->attach([Auth::user()->profile->id],[
                'interest'=>[
                    'interests'=>$this->interest,
                    'others'=>$this->others
                ]
            ]);
            $this->interest_recorded=true;
            $this->emit('help_added');
        }
        else{
            return redirect()->guest('login')->with('status', 'Please login to perform this action');
        }        
    }
    public function toggleInterest(){
        if(Auth::user()){
            $this->model->interested_profiles()->toggle([Auth::user()->profile->id]);
            $this->emit('help_added');
        }
        else{
            return redirect()->guest('login')->with('status', 'Please login to perform this action');
        }
    }
    public function render()
    {
        $this->model->loadCount(['interested_profiles as interested_profiles_count' => function($query) {
    $query->select(DB::raw('count(distinct(profile_id))'));
}]);
        return view('livewire.card-interests');
    }
}
