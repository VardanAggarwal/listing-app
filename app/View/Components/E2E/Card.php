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
    public $strings=[];
    public $updated;
    public function __construct($item,$type)
    {
        switch($type){
            case "trade":
                $this->title=$item->name;
                if($item->price){
                    array_push($this->strings, "Rs. ".$item->price."/kg");
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
                array_push($this->strings, "Rs. ".$item->min."/kg - Rs.".$item->max."/kg");
                array_push($this->strings, $item->count." Offers");
                break;
            case "select":
                $this->title=$item->name;
                $this->image=$item->image_url;
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
