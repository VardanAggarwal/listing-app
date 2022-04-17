<?php

namespace App\Http\Livewire\E2E\Screens;

use Livewire\Component;
use App\Models;
class Card extends Component
{
    public $image;
    public $title;
    public $data=[];
    public $updated;
    public function mount($item,$type){
        switch($type){
            case "trade":
                $this->title=$item->name;
                if($item->price){
                    array_push($this->data, "Rs. ".$item->price."/kg");
                    $this->updated=$item->date;
                }
                if($item->media){
                    $this->image=$item->media;
                }else{
                    $this->image=$item->image_url;
                }
                break;
            case "item":
                $this->title=$item->name;
                $this->image=$item->image_url;
                array_push($this->data, "Rs. ".$item->min."/kg - Rs.".$item->max."/kg");
                array_push($this->data, $item->count." Offers");
        }
    }
    public function render()
    {
        return view('livewire.e2-e.screens.card');
    }
}
