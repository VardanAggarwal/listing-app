<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RelationshipSearch extends Component
{   
    public $type;
    public $models;
    public $results;
    public $search_model;
    public $title='What is this related to?';
    public $selected=[];
    protected $listeners=['updateData'];
    public function updateData($type,$selected){
        $this->type=$type;
        $this->selected=$selected;
    }
    public function toggleSelected($item){
        if(in_array($item,$this->selected)){
            $this->selected=array_diff( $this->selected, [$item] );
        }else{
        array_push($this->selected,$item);
        }
        $this->emit('updateSelected',$this->selected);        
    }
    public function newModel(){
        $namespace="App\\Models\\".$this->type;
        $model=$namespace::create(['name'=>$this->search_model]);
        $this->search_model='';
        array_push($this->selected,$model->id);
        $this->emit('updateSelected',$this->selected);
    }
    public function render()
    {
        $namespace="App\\Models\\".$this->type;
        $this->models=$namespace::findMany($this->selected);
        $this->results=$namespace::search($this->search_model)->take(20)->get();
        return view('livewire.relationship-search');
    }
}
