<?php

namespace App\Http\Livewire\Expert;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class Form extends Component
{
    public $selected=[];
    protected $listeners = ['updateSelected'];
    public $services=[];
    public $contact=['whatsapp'=>null,'call'=>null];
    public $rules=[
        'contact.whatsapp'=>'numeric|nullable|digits:10',
        'contact.call'=>'numeric|nullable|digits:10'
    ];
    public $service_types=['seed','input','knowledge','training','contract_farming','marketing','others'];

    public function mount(){
        if($profile=Auth::user()->profile){
            $number=str_replace("+91","",$profile->contact_number);
            $this->contact['whatsapp']=$number;
            $this->contact['call']=$number;
        }
    }
    public function save(){
        $data=[
            'services'=>$this->services
        ];
        Auth::user()->profile->expert_resiliencies()->syncWithPivotValues($this->selected, ['data' => $data]);
        foreach ($this->contact as $key => $value) {
            $this->contact[$key]="+91".$value;
        }
        Auth::user()->profile->additional_info=["contact"=>$this->contact];
        Auth::user()->profile->save();
        return redirect('profiles/'.Auth::user()->profile->id);
    }
    public function toggleContact($type){
        if($this->contact[$type]){
            $this->contact[$type]=null;
        }else{
            if($profile=Auth::user()->profile){
                $number=str_replace("+91","",$profile->contact_number);
                $this->contact[$type]=$number;
            }       
        }
    }
    public function updateSelected($selected){
        $this->selected=$selected;
    }
    public function toggleService($item){
        if(in_array($item,$this->services)){
            $this->services=array_diff( $this->services, [$item] );
        }else{
        array_push($this->services,$item);
        }
    }
    public function render()
    {
        return view('livewire.expert.form')->layout('layouts.guest');
    }
}
