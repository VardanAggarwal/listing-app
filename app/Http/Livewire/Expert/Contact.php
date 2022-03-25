<?php

namespace App\Http\Livewire\Expert;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Profile;
class Contact extends Component
{
    public $profile;
    public $version=1;
    public $call=null;
    public $whatsapp=null;
    public $type;
    public $href;
    public $login=false;
    public $phone_number;
    public $pincode;
    public $expert=false;
    public $selected=['resiliency'=>[],'service'=>[]];
    public $services;
    public $service_types=['seed'=>'seedling','input'=>'basket-shopping','knowledge'=>'handshake-angle','training'=>'user-graduate','animal'=>'horse','machinery'=>'tractor','contract_farming'=>'sync','marketing'=>'money-bill-wave','others'=>'basket-shopping'];
    protected $rules=[
        'phone_number'=>'sometimes|numeric|required|digits:10',
        'pincode'=>'sometimes|numeric|digits:6|required'
    ];
    public function mount($profile){
        $this->profile=$profile;
        $number=$profile->contact_number;
        $contact=null;
        if($profile->additional_info){
            if(isset($profile->additional_info['contact'])){
                $contact=$profile->additional_info['contact'];
            }
        }
        if($contact){
            $this->call=$contact['call'];
            $this->whatsapp=$contact['whatsapp'];
        }elseif($number){
            $this->call=$number;
            $this->whatsapp=$number;
        }
        if($profile->expert_resiliencies){
            $this->expert=true;
        }
        $this->services=$profile->expert_resiliencies->reduce(function($services,$item){
            return $services=array_unique(array_merge($services,$item->pivot->data['services']));
        },[]);
        $agent=request()->header('User-Agent');
        if(($pos=strpos($agent,'Seed Savers Club')!==FALSE)){
          if(($pos=strpos($agent,'Seed Savers Club-')!==FALSE)){
            $version= str_replace('Seed Savers Club-','',request()->header('User-Agent')); 
            request()->session()->put('version', $version);
          }else{
            $version='0';
          }
        }else{
          $version='1';
        }
        if(Auth::user()){
            if(Auth::user()->profile){
                $this->login=Auth::user()->profile;
                $this->pincode=Auth::user()->profile->pincode;
                $this->phone_number=Auth::user()->profile->contact_number;
            }
        }
    }

    public function toggleSelected($type,$item){
        if(in_array($item,$this->selected[$type])){
            $this->selected[$type]=array_diff( $this->selected[$type], [$item] );
        }else{
        array_push($this->selected[$type],$item);
        }
    }
    public function submit(){
        $selected=$this->selected;
        if(isset(Auth::user()->profile)){
            $profile=Auth::user()->profile;
        }
        else{
            $this->validate();
            $phone_number="+91".$this->phone_number;
            $user=User::firstOrCreate(['phone_number'=>$phone_number]);
            if($user->profile){
                $profile=$user->profile;
            }else{
                $profile=Profile::firstOrCreate(['contact_number'=>$phone_number],['pincode'=>$this->pincode]);
                $profile->user()->associate($user);
                $profile->save();
            }
            Auth::login($user,$remember=true);
        }
        $interest=["interests"=>array_values($selected['service'])];
        if($selected['resiliency']){
            $profile->interest_resiliencies()->attach(array_values($selected['resiliency']),["interest"=>$interest]);
        }
        $interest=["resiliencies"=>$selected['resiliency'],"interests"=>$selected['service']];
        $profile->interest_profiles()->attach([$this->profile->id],["interest"=>$interest]);
        return redirect($this->href);
    }
    public function render()
    {
        return view('livewire.expert.contact');
    }
}
