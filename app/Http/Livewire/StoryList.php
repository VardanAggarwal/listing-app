<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Story;

class StoryList extends Component
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
        $this->feed=Story::with(['profile.user'])->orderByDesc('id')->cursorPaginate($this->perPage);
        return view('livewire.story-list',['feed'=>$this->feed])->layout('layouts.guest');
    }
}
