<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Resiliency;
use App\Models\Category;

class ResiliencyList extends Component
{
    public $perPage = 0;
    public $cardCount = 0;
    public $loading=false;
    public $query='';
    protected $categories;
    public $others;
    protected $feed;
    protected $queryString = [
        'query'=>['except'=>'']
    ];
    public function mount(){
        $this->others=Resiliency::doesntHave('categories')->get();
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
        $this->categories=Category::has('resiliencies')->withCount(['resiliencies','interested_profiles'])->orderByDesc('interested_profiles_count')->orderByDesc('resiliencies_count')->paginate($this->cardCount);
        if($this->query){
        $this->feed=Resiliency::search($this->query)->paginate($this->perPage);
        }
        else{
            $this->feed=Resiliency::withAvg('stories','rating')->withCount('interested_profiles')->orderByDesc('interested_profiles_count')->latest()->cursorPaginate($this->perPage);
        }
        return view('livewire.resiliency-list',['feed'=>$this->feed,'categories'=>$this->categories])->layout('layouts.guest');
    }
}
