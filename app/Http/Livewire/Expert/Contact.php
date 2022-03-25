<?php

namespace App\Http\Livewire\Expert;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class Contact extends Component
{
    public $profile;
    public $version=1;
    public $form=false;
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
        dd($type,$item);
        if(in_array($item,$this->selected[$type])){
            $this->selected[$type]=array_diff( $this->selected[$type], [$item] );
        }else{
        array_push($this->selected[$type],$item);
        }
    }
    public function render()
    {
        return view('livewire.expert.contact');
    }
}
