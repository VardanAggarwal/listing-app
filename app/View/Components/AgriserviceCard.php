<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Str;
class AgriserviceCard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $model;
    public function __construct($item)
    {
        $this->model=$item->feedable;
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.agriservice-card');
    }
}
