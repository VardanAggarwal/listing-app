<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Resiliency;

class ResiliencyList extends Component
{
    public $perPage = 10;
    public $loading=false;
    protected $feed;

    public function loadMore()
       {
           $this->perPage += 10;
       }
    public function render()
    {
        $this->feed=Resiliency::orderByDesc('id')->cursorPaginate($this->perPage);
        return view('livewire.resiliency-list',['feed'=>$this->feed])->layout('layouts.guest');
    }
}
