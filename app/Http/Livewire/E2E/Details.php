<?php

namespace App\Http\Livewire\E2E;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class Details extends Component
{
    public $roles;
    public $producer_types=["farmer","farmer_group"];
    public $organisation_types=["fpo","co_operative","self_help_group","ngo","private_company","unregistered_group"];
    public $producer_type="farmer";
    public $profile;
    public $business_id;
    public $landholding;
    public $org=['type'=>"fpo"];
    protected $rules=[
        'profile.name'=>'string|required',
        'profile.address'=>'string|required',
        'profile.pincode'=>'numeric|digits:6|required',
        'org.type'=>'sometimes|string',
        'org.members'=>'sometimes|numeric',
        'org.landholding'=>'sometimes|numeric',
        'landholding'=>''
    ];
    public function mount(){
        if(Auth::user()){
            if(Auth::user()->profile->personas){
                $this->roles=explode(", ", Auth::user()->profile->personas);
            }
            $this->profile=Auth::user()->profile;
            if(isset($this->profile->additional_info['profile_data'])){
                $data=$this->profile->additional_info['profile_data'];
            }
            if(isset($data['producer_type'])){
                $this->producer_type=$data['producer_type'];
            }
            if(isset($data['landholding'])){
                $this->landholding=$data['landholding'];
                $this->org['landholding']=$data['landholding'];
            }
            if(isset($data['org_type'])){
                $this->org['type']=$data['org_type'];
            }
            if(isset($data['members'])){
                $this->org['members']=$data['members'];
            }
            if(isset($data['business_id'])){
                $this->business_id=$data['business_id'];
            }
        }
    }
    public function submit(){
        $this->validate();
        $roles=$this->roles;
        Auth::User()->name=$this->profile->name;
        $data=[];
        if(count(array_intersect($roles,['producer']))>0){
            $data['producer_type']=$this->producer_type;
            if($this->producer_type=="farmer_group"){
                $data['org_type']=$this->org['type'];
                $data['members']=$this->org['members'];
                $data['landholding']=$this->org['landholding'];
            }else{
                $data['landholding']=$this->landholding;
            }
        }
        if(count(array_intersect($roles,['trader','processor','buyer']))>0){
            $data['business_id']=$this->business_id;
        }
        $additional_info=$this->profile->additional_info;
        $additional_info['profile_data']=$data;
        $this->profile->additional_info=$additional_info;
        $this->profile->save();
        Auth::User()->save();
        if($this->profile->interest_resiliencies){
            return redirect()->intended('/e2e/actions');
        }else{
            return redirect()->intended('/e2e/vcs');
        }
    }
    public function render()
    {
        return view('livewire.e2-e.details')->layout('layouts.e2e');
    }
}
