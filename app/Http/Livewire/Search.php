<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Resiliency;
use App\Models\Listing;
use App\Models\Story;
use Illuminate\Support\Str;
class Search extends Component
{
    public $perPage = 10;
    public $query='';
    protected $results;
    public $search_type='Resiliency';
    
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
            $class="App\\Models\\".$this->search_type;
            $this->results=$class::search($this->query)->paginate($this->perPage);
        }
        return view('livewire.search',['results'=>$this->results])->layout('layouts.guest');
    }
}
