<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Story;
use App\Models\Resiliency;

class StoryList extends Component
{
    public $perPage = 10;
    public $cardCount = 0;
    public $loading=false;
    public $query='';
    protected $resiliencies;
    public $others;
    protected $feed;
    protected $queryString = [
        'query'=>['except'=>'']
    ];
    public function mount(){
        $this->others=Story::doesntHave('resiliencies')->get();
    }
    public function loadMore($type)
       {
           $this->{$type} += 5;
       }
    public function resetPage(){
        $this->reset('perPage');
    }
    public function render()
    {
        $this->resiliencies=Resiliency::has('listings')->withCount(['listings','interested_profiles'])->orderByDesc('interested_profiles_count')->orderByDesc('listings_count')->paginate($this->cardCount);
        if($this->query){
            $this->feed=Story::search($this->query)->paginate($this->perPage);
        }
        else{
            $this->feed=Story::with(['profile.user'])->orderByDesc('id')->cursorPaginate($this->perPage);
        }
        return view('livewire.story-list',['feed'=>$this->feed,'resiliencies'=>$this->resiliencies])->layout('layouts.guest');
    }
}
