<?php

namespace App\View\Components\E2E;

use Illuminate\View\Component;

class Card extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $image;
    public $title;
    public $type;
    public $strings=[];
    public $updated;
    public function __construct($item,$type,$action=null)
    {
        switch($type){
            case "trade":
                $this->title=$item->name;
                if($item->price){
                    array_push($this->strings, __('e2e.global.units.rupees')." ".$item->price."/".__('e2e.global.units.kg'));
                    $this->updated=$item->updated_at->format('d/m/Y');
                }
                if($item->quantity){
                    array_push($this->strings, $item->quantity.' '.__('e2e.global.units.kg'));   
                }
                $this->image=$item->image_url;
                break;
            case "item":
                $this->title=$item->name;
                $this->image=$item->image_url;
                if($item->min){
                    if($item->min!=$item->max){
                        array_push($this->strings, __('e2e.global.units.rupees')." ".$item->min." - ".$item->max."/".__('e2e.global.units.kg'));
                    }else{
                        array_push($this->strings, __('e2e.global.units.rupees')." ".$item->min."/".__('e2e.global.units.kg'));
                    }
                }
                if($item->count>0&&$action){
                    array_push($this->strings, $item->count.' '.__('e2e.cards.count_label.'.$action));
                }
                break;
            case "select":
                $this->title=$item->name;
                $this->image=$item->image_url;
                break;
            case "supplier":
                $this->title=__('e2e.global.units.rupees')." ".$item->price."/".__('e2e.global.units.kg');
                if($item->quantity){
                    $this->title.=", ".intval($item->quantity/100)." ".__('e2e.global.units.qt');
                }
                if(isset($item->additional_info->image_url)){
                    $this->image=$item->additional_info->image_url;
                }else{
                    $this->image=$item->item->image_url;
                }
                array_push($this->strings, $item->profile->name);
                array_push($this->strings, $item->profile->address);
                $this->updated=$item->updated_at->format('d-m-Y');
                break;
            case "profile":
                $this->title=$item->name;
                if($item->type){
                    $this->type=$item->type;
                }
                if($item->price){
                    array_push($this->strings, __('e2e.global.units.rupees')." ".$item->price."/".__('e2e.global.units.kg'));
                    $this->updated=$item->updated_at->format('d/m/Y');
                }
                if($item->quantity){
                    array_push($this->strings, $item->quantity.__('e2e.global.units.kg'));   
                }
                $this->image=$item->image_url;
                break;
        }
        if(!$this->image){
            $this->image="https://via.placeholder.com/300x200.jpg/".dechex(mt_rand(0x555555, 0xFFFFFF))."/000000?text=".urlencode($this->title);
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.e2-e.card');
    }
}
