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
    public function __construct($item,$type)
    {
        switch($type){
            case "trade":
                $this->title=$item->name;
                if($item->price){
                    array_push($this->strings, "Rs. ".$item->price."/kg");
                    $this->updated=$item->updated_at->format('d/m/Y');
                }
                $this->image=$item->image_url;
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
                break;
            case "supplier":
                $this->title="Rs. ".$item->price."/kg";
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
                    array_push($this->strings, "Rs. ".$item->price."/kg");
                    $this->updated=$item->updated_at->format('d/m/Y');
                }
                if($item->quantity){
                    array_push($this->strings, $item->quantity."kg");   
                }
                $this->image=$item->image_url;
                break;
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
