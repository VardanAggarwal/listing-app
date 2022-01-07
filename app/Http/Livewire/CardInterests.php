<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Resiliency;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class CardInterests extends Component
{
    public $interest_recorded=false;
    public $type;
    public $model;
    public $interest=[];
    public $others="";

    public function save_interest(){
        if(Auth::user()){
            Auth::user()->profile->interest_resiliencies()->attach([$this->model->id],[
                'interest'=>[
                    'interests'=>$this->interest,
                    'others'=>$this->others
                ]
            ]);
            $this->interest_recorded=true;
        }
        else{
            return redirect()->guest('login')->with('status', 'Please login to perform this action');
        }        
    }
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
        $this->model->loadCount(['interested_profiles as interested_profiles_count' => function($query) {
    $query->select(DB::raw('count(distinct(profile_id))'));
}]);
        return view('livewire.card-interests');
    }
}
