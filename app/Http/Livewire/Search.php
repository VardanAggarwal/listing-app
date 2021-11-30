<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Resiliency;
use Illuminate\Support\Str;
class Search extends Component
{
    public $perPage = 3;
    public $search='';
    protected $results;

    public function loadMore()
       {
           $this->perPage += 10;
       }   
    public function render()
    {
        if($this->search){
        $this->results=Resiliency::search($this->search)->paginate($this->perPage);
        }
        return view('livewire.search',['results'=>$this->results])->layout('layouts.guest');
    }
}
