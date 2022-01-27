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
    public $index;
    public function __construct($item,$index)
    {
        $this->index=$index;
        $this->type=Str::lower(Str::replace('App\\Models\\','', $item->feedable_type));
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
