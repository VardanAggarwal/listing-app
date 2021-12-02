<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Resiliency;
use Illuminate\Support\Facades\Auth;
class InterestSearch extends Component
{
    public $perPage = 20;
    public $query='';
    protected $results;
    public $selected=[];
    public function loadMore()
       {
           $this->perPage += 20;
       }   
    public function resetPage(){
        $this->reset('perPage');
    }
    public function mount(){
        $this->selected=Auth::user()->profile->resiliencies->modelKeys();
    }
    public function toggleSelected($item){
        if(in_array($item,$this->selected)){
            $this->selected=array_diff( $this->selected, [$item] );
        }else{
        array_push($this->selected,$item);
        }
    }
    public function save(){
        Auth::user()->profile->resiliencies()->sync($this->selected);
        return redirect('/');
    }
    public function render()
    {
        $this->results=Resiliency::search($this->query)->paginate($this->perPage);
        $paginate=$this->results;
        $this->results=$this->results->mapToGroups(function($item,$key){
            return [$item['resilient_type']=>$item];
        });
        return view('livewire.interest-search',['results'=>$this->results->all(),'paginate'=>$paginate,'selected'=>$this->selected])->layout('layouts.guest');
    }
}
