<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Str;
class ContactProfile extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $number;
    public $profile;
    public function __construct($profile)
    {
        $this->profile=$profile;
        $this->number=$profile->contact_number;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.contact-profile');
    }
}
