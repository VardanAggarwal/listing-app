<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models;
class CardGroup extends Component
{
    protected $feed;
    public $index;
    public $title="Recommended for you";
    public function mount(){
        $this->feed=Models\Statement::orderByDesc('updated_at')->take(10)->get();
    }
    public function render()
    {
        return view('livewire.card-group',['feed'=>$this->feed]);
    }
}
