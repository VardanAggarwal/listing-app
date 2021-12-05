<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
class RelationshipFilteredList extends Component
{
    public $perPage = 3;
    public $loading=false;
    protected $feed;
    public $relation;
    public $model;
    public function loadMore()
       {
           $this->perPage += 5;
       }
    public function mount($relation,$model){
        $this->relation=$relation;
        $this->model=$model;
    }
    public function render()
    {
        $this->feed=$this->model->{$this->relation}()->orderByDesc('id')->cursorPaginate($this->perPage);
        return view('livewire.relationship-filtered-list',['feed'=>$this->feed,'type'=>Str::singular($this->relation)])->layout('layouts.guest');
    }
}
