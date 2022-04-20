<?php

namespace App\Http\Livewire\E2E;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class BottomNav extends Component
{
    public $items=[
        "input_provider"=>[
            "buy"=>"seedling"
        ],
        "farmer"=>[
            "buy"=>"seedling",
            "sell"=>"money-bill-wave"
        ],
        "trader"=>[
            "sell"=>"building-wheat",
            "buy"=>"truck"
        ],
        "buyer"=>[
            "buy"=>"truck"
        ]
    ];
    public $nav_items;
    public $role;
    public $action;
    public function mount(){
        $this->nav_items=$this->items[$this->role];
    }
    public function navigate($nav){
        $this->emit('navigate',$action=$nav);
    }
    public function render()
    {
        return view('livewire.e2-e.bottom-nav');
    }
}
