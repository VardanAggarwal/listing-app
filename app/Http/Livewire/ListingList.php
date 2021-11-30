<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Listing;

class ListingList extends Component
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
        $this->feed=Listing::with(['profile'])->orderByDesc('id')->cursorPaginate($this->perPage);
        return view('livewire.listing-list',['feed'=>$this->feed])->layout('layouts.guest');
    }
}
