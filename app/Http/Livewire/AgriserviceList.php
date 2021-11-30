<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Agriservice;

class AgriserviceList extends Component
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
        $this->feed=Agriservice::with(['profile'])->orderByDesc('id')->cursorPaginate($this->perPage);
        return view('livewire.agriservice-list',['feed'=>$this->feed])->layout('layouts.guest');
    }
}
