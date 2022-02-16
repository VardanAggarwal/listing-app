<?php

namespace App\Http\Livewire\Expert;

use Livewire\Component;

class Card extends Component
{
    public $profile;
    public $services;
    public $service_types=['seed'=>'seedling','input'=>'basket-shopping','knowledge'=>'handshake-angle','training'=>'user-graduate','contract_farming'=>'sync','marketing'=>'money-bill-wave','others'=>'basket-shopping'];
    public function mount($profile){
        $this->profile=$profile;
        $this->services=$profile->expert_resiliencies->reduce(function($services,$item){
            return $services=array_unique(array_merge($services,$item->pivot->data['services']));
        },[]);

    }
    public function render()
    {
        return view('livewire.expert.card');
    }
}
