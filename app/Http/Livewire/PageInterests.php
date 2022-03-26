<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class PageInterests extends Component
{
    public $model;
    public $type;
    public $user_interests=null;
    protected $listeners = ['help_added' => '$refresh'];
    public function toggleInterest($key){
        if(Auth::user()){
            if($this->user_interests->contains($key)){
                $this->model->interested_profiles()->detach(Auth::user()->profile->id);
            }else{
                if(in_array($key,['seed','input','market','marketing','advice','training','connect','payment','logistics'])){
                    $interest=[
                        'interests'=>[$key],
                        'others'=>''
                    ];
                }
                else{
                 $interest=[
                     'interests'=>['others'],
                     'others'=>$key
                 ];   
                }
                $this->model->interested_profiles()->attach([Auth::user()->profile->id],['interest'=>$interest]);
            }
            $this->emit('interest_updated');
            $this->emit('help_added');
        }   
        else{
            return redirect()->guest('login')->with('status', 'Please login to perform this action');
        }     
    }
    public function render()
    {
        if(Auth::user()){
            $this->user_interests = $this->model->interested_profiles->filter(
                function($value,$key){
                    return $value->user_id==Auth::user()->id;
                })->map(
                function($value,$key){
                    return $value->pivot->interest;
                })->flatten();
        }
        $interests= $this->model->interested_profiles->map(
            function($value,$key){
                    return $value->pivot->interest;
            })->flatten()->countBy();
        return view('livewire.page-interests',['interests'=>$interests]);
    }
}
