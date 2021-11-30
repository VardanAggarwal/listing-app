<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Resiliency;
use App\Models\Practice;

class PracticeList extends Component
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
        $this->feed=Resiliency::whereHasMorph('resilient',[Practice::class])->with(['categories','resilient'])->orderByDesc('id')->cursorPaginate($this->perPage);
        return view('livewire.practice-list',['feed'=>$this->feed])->layout('layouts.guest');
    }
}
