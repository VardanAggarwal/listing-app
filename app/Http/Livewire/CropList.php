<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Resiliency;
use App\Models\Crop;

class CropList extends Component
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
        $this->feed=Resiliency::whereHasMorph('resilient',[Crop::class])->with(['categories','resilient'])->orderByDesc('id')->cursorPaginate($this->perPage);
        return view('livewire.crop-list',['feed'=>$this->feed])->layout('layouts.guest');
    }
}
