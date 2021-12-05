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
           $this->perPage += 10;
       }   

    public function mount(){
        $this->selected=Auth::user()->profile->interest_resiliencies->modelKeys();
    }
    public function toggleSelected($item){
        if(in_array($item,$this->selected)){
            $this->selected=array_diff( $this->selected, [$item] );
        }else{
        array_push($this->selected,$item);
        }
    }
    public function save(){
        Auth::user()->profile->interest_resiliencies()->syncWithPivotValues($this->selected,['interest'=>'like']);
        return redirect('/');
    }
    public function render()
    {
        $this->results=Resiliency::search($this->query)->paginate($this->perPage);
        return view('livewire.interest-search',['results'=>$this->results,'selected'=>$this->selected])->layout('layouts.guest');
    }
}
