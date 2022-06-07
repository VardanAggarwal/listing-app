<?php

namespace App\Http\Livewire\E2E;

use Livewire\Component;
use App\Models;
class AddPrice extends Component
{
    public $market;
    public $prices=[0=>[]];
    public $listeners=['updateRow'];
    public function addRow(){
        array_push($this->prices,[]);
    }
    public function updateRow($item,$key){
        $this->prices[$key]=$item;
    }
    public function submit(){
        foreach($this->prices as $price){
            $price['date']=now();
            $price['market']=$this->market;
            Models\Price::create($price);   
        }
    }
    public function render()
    {
        return view('livewire.e2-e.add-price')->layout('layouts.e2e');
    }
}
