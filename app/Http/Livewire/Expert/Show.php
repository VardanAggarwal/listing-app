<?php

namespace App\Http\Livewire\Expert;

use Livewire\Component;

class Show extends Component
{
    public $profile;
    public $services;
    public function mount($profile){
        $this->services=$profile->expert_resiliencies->reduce(function($services,$item){
            return $services=array_unique(array_merge($services,$item->pivot->data['services']));
        },[]);

    }
    public function render()
    {
        return view('livewire.expert.show');
    }
}
