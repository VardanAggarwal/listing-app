<?php

namespace App\Http\Livewire\E2E;

use Livewire\Component;
use App\Models;
class PriceItem extends Component
{
    public $item;
    public $index;
    public $items;
    public $item_name;
    public $price_min;
    public $price_max;
    public $price_avg;
    public function setItem($item){
        $this->item=$item;
        $this->item_name=$item['name'];
        $this->items=null;
    }
    public function render()
    {
        if(!$this->item&&$this->item_name){
            $this->items=Models\Item::search($this->item_name)->get();
        }
        if($this->item){
            $this->emit('updateRow',['item_id'=>$this->item['id'],'price_min'=>$this->price_min,'price_max'=>$this->price_max,'price_avg'=>$this->price_avg],$this->index);
        }
        return view('livewire.e2-e.price-item');
    }
}
