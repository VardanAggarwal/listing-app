<?php

namespace App\Http\Livewire\E2E;

use Livewire\Component;
use App\Models;

class VCs extends Component
{
    public $resiliency_ids=[25,41,46,1,113,115,33,43,50,114,116];
    public $selected=[];
    public function render()
    {
        $resiliencies=Models\Resiliency::findMany($this->resiliency_ids);
        return view('livewire.e2-e.v-cs',['resiliencies'=>$resiliencies])->layout('layouts.e2e');
    }
}
