<?php

namespace App\Http\Livewire\Leads;

use Livewire\Component;
use App\Models\Resiliency;
class Form extends Component
{
    public $resiliency_ids=[25,41,46,1,113,115,33,43,50,114,116];
    public $selected=[];
    public $form=false;
    public $success=false;
    public function submit(){
        $this->form=false;
        $this->success=true;
    }
    public function toggleSelected($item){
        if(in_array($item,$this->selected)){
            $this->selected=array_diff( $this->selected, [$item] );
        }else{
        array_push($this->selected,$item);
        }
    }
    public function render()
    {
        $resiliencies=Resiliency::findMany($this->resiliency_ids);
        return view('livewire.leads.form',['resiliencies'=>$resiliencies])->layout('layouts.guest');
    }
}
