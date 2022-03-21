<?php

namespace App\Http\Livewire\Onboarding;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models;
class Services extends Component
{
    public $services=[];
    public $stage="services";
    public $resiliency_ids=[25,41,46,1,113,115,33,43,50,114,116];
    protected $resiliencies;
    public $selected=[];
    public $profile;
    protected $listeners = ['updateSelected'];
    public function mount(){
        if(Auth::user()->profile){
            $this->profile=Auth::user()->profile;
        }else{
            return redirect('/login');
        }
    }
    public function setService($service,$role){
        $services=$this->services;
        if(isset($services[$service])){
            $services[$service]=$services[$service]==$role?null:$role;
        }else{
            $services[$service]=$role;
        }
        $this->services=$services;
    }
    public function toggleSelected($item){
        if(in_array($item,$this->selected)){
            $this->selected=array_diff( $this->selected, [$item] );
        }else{
        array_push($this->selected,$item);
        }
        $this->emit('updateData','Resiliency',$this->selected);
    }
    public function updateSelected($selected){
        $this->selected=$selected;
    }
    public function submit(){
        if(count($this->selected)==0){
            $this->addError('selected', __('Select at least one Agri-business'));
        }else{

            $interest=[];
            $data=null;
            $resiliencies=$this->selected;
            if(count($this->services)>0){
                $services=collect($this->services)->mapToGroups(function($item,$key){
                    return [$item=>$key];
                });
                if(isset($services['user'])){
                    $interest=[
                        'interests'=>$services['user']
                    ];
                }
                if(isset($services['expert'])){
                    $data=[
                        'services'=>$services['expert']
                    ];
                    if(count($services['expert'])>0){
                        $this->profile->expert_resiliencies()->syncWithPivotValues($resiliencies, ['data' => $data]);
                    }
                }
            }
            $this->profile->interest_resiliencies()->attach($resiliencies,['interest'=>$interest]);
            if($this->profile->additional_info){
                $this->profile->additional_info=array_merge($this->profile->additional_info,["onboarding"=>true]);
            }else{
                $this->profile->additional_info=["onboarding"=>true];
            }
            $this->profile->save();
            return redirect('/');
        }
    }
    public function render()
    {   $resiliencies=Models\Resiliency::findMany($this->resiliency_ids);
        return view('livewire.onboarding.services',['resiliencies'=>$resiliencies])->layout('layouts.guest');
    }
}
