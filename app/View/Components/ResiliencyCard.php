<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ResiliencyCard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $resiliency;
    public function __construct($resiliency)
    {
        $this->resiliency=$resiliency;
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.resiliency-card');
    }
}
