<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Feed;

class FeedList extends Component
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
        $this->feed=Feed::with(['feedable','resiliency'])->orderByDesc('id')->cursorPaginate($this->perPage);
        return view('livewire.feed-list',['feed'=>$this->feed])->layout('layouts.guest');
    }
}
