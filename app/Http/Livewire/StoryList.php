<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Story;

class StoryList extends Component
{
    public $perPage = 10;
    public $loading=false;
    public $query='';
    protected $feed;

    public function loadMore()
       {
           $this->perPage += 10;
       }
    public function resetPage(){
        $this->reset('perPage');
    }
    public function render()
    {
        if($this->query){
            $this->feed=Story::search($this->query)->paginate($this->perPage);
        }
        else{
            $this->feed=Story::with(['profile.user'])->orderByDesc('id')->cursorPaginate($this->perPage);
        }
        return view('livewire.story-list',['feed'=>$this->feed])->layout('layouts.guest');
    }
}
