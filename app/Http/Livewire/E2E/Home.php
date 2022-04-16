<?php

namespace App\Http\Livewire\E2E;

use Livewire\Component;

class Home extends Component
{
    public $screen="price-discovery";
    protected $listeners=['navigate'];
    public function navigate($screen){
        $this->screen=$screen;
    }
    public function render()
    {
        return view('livewire.e2-e.home')->layout('layouts.e2e');
    }
}
