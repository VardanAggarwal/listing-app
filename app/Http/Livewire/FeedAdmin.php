<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\FeedGroup;
class FeedAdmin extends Component
{
    public $models=['Resiliency','Story','Listing','Profile'];
    public $model = 'Resiliency';
    public $selected=[];
    protected $listeners = ['updateSelected'];
    public function updateSelected($selected){
        $this->selected=$selected;
    }
    public function mount(){
        $this->updatedModel();
    }
    public function updatedModel(){
        $feedgroup=FeedGroup::where(['model'=>$this->model,'purpose'=>'admin_pick'])->first();
        if($feedgroup){
            $this->selected=$feedgroup->data['id'];
        }else{
            $this->selected=[];
        }
        $this->emit('updateData',$type=$this->model,$selected=$this->selected);
    }
    public function save(){
        $feedgroup=FeedGroup::firstOrCreate(['model'=>$this->model,'purpose'=>'admin_pick'],['data'=>['type'=>'id','id'=>$this->selected]]);
        $feedgroup->update(['data->id'=>$this->selected]);
        $feedgroup->save();
        session()->flash('message','Feed for '.$this->model.' was saved.');
    }
    public function render()
    {
        return view('livewire.feed-admin')->layout('layouts.guest');
    }
}
