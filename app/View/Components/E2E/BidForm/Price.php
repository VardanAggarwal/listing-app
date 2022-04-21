<?php

namespace App\View\Components\E2E\BidForm;

use Illuminate\View\Component;

class Price extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $item_type;
    public $type;
    public $prices;
    public function __construct($itemType,$type,$prices)
    {
      $this->item_type=$itemType;
      $this->type=$type;
      $this->prices=$prices;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.e2-e.bid-form.price');
    }
}
