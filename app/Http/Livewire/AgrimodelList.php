<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Resiliency;
use App\Models\Agrimodel;

class AgrimodelList extends Component
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
        $this->feed=Resiliency::whereHasMorph('resilient',[Agrimodel::class])->with(['categories','resilient'])->orderByDesc('id')->cursorPaginate($this->perPage);
        return view('livewire.agrimodel-list',['feed'=>$this->feed])->layout('layouts.guest');
    }
}
