<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Resiliency;
use Illuminate\Support\Str;
class Search extends Component
{
    public $perPage = 10;
    public $query='';
    protected $results;
    
   protected $queryString = [
       'query' => ['except' => '','as'=>'q']
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
        $this->results=Resiliency::search($this->query)->paginate($this->perPage);
        }
        return view('livewire.search',['results'=>$this->results])->layout('layouts.guest');
    }
}
