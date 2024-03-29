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
    protected $listeners=['refreshStatement'=>'$refresh'];
    public function loadMore()
       {
           $this->perPage += 10;
       }
    public function mount($relation,$model){
        $this->relation=$relation;
        $this->model=$model;
    }
    public function render()
    {
        $this->feed=$this->model->{$this->relation}()->orderByDesc('updated_at')->cursorPaginate($this->perPage);
        return view('livewire.relationship-filtered-list',['feed'=>$this->feed,'type'=>Str::singular($this->relation)])->layout('layouts.guest');
    }
}
