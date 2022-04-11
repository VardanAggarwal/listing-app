<?php

namespace App\Http\Livewire\E2E;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class PriceDiscovery extends Component
{
    public $resiliencies;
    public function mount(){
        if(Auth::user()){
            if(isset(Auth::user()->profile->interest_resiliencies)){
                $this->resiliencies=Auth::user()->profile->interest_resiliencies->unique();
            }
        }
    }
    public function render()
    {
        return view('livewire.e2-e.price-discovery');
    }
}
