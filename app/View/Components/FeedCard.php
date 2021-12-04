<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;
class FeedCard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $type;
    public $item;
    public $item_type;
    public function __construct($item)
    {
        $this->item_type=Str::lower(Str::replace('App\\Models\\','', $item->feedable_type));
        if ($this->item_type=='resiliency'){
            $this->type='resiliency';
        }
        else{
            $this->type='reliable';
        }
        $this->item=$item;
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.feed-card');
    }
}
