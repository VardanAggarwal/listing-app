<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Resiliency;
use Illuminate\Support\Facades\Auth;
class InterestSearch extends Component
{
    public $perPage = 10;
    public $query='';
    protected $results;
    public $selected=[];
    public function loadMore()
       {
           $this->perPage += 15;
       }   

    public function mount(){
        if(Auth::user()->profile){
            $this->selected=Auth::user()->profile->interest_resiliencies->modelKeys();
        }else{
            return redirect('/profile');
        }
    }
    public function toggleSelected($item){
        if(in_array($item,$this->selected)){
            $this->selected=array_diff( $this->selected, [$item] );
        }else{
        array_push($this->selected,$item);
        }
    }
    public function newResiliency(){
        $resiliency=Resiliency::create(['name'=>$this->query]);
        $this->query='';
        array_push($this->selected,$resiliency->id);
    }
    public function save(){
        Auth::user()->profile->interest_resiliencies()->sync($this->selected);
        return redirect('/profile');
    }
    public function render()
    {
        $this->resiliencies=Resiliency::findMany($this->selected);
        $this->results=Resiliency::search($this->query)->paginate($this->perPage);
        return view('livewire.interest-search',['results'=>$this->results,'selected'=>$this->selected])->layout('layouts.guest');
    }
}
