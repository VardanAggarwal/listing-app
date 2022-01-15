<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Resiliency;

class ResiliencyList extends Component
{
    public $perPage = 10;
    public $loading=false;
    public $query='';
    protected $feed;
    protected $queryString = [
        'query'=>['except'=>'']
    ];
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
        $this->feed=Resiliency::search($this->query)->paginate($this->perPage);
        }
        else{
            $this->feed=Resiliency::withAvg('stories','rating')->withCount('interested_profiles')->orderByDesc('interested_profiles_count')->cursorPaginate($this->perPage);
        }
        return view('livewire.resiliency-list',['feed'=>$this->feed])->layout('layouts.guest');
    }
}
