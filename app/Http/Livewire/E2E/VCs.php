<?php

namespace App\Http\Livewire\E2E;

use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use App\Models;

class VCs extends Component
{
    public $categories=[1,22];
    public $selected=[];
    public $query="";

    public function mount(){
        if(Auth::user()->profile){
            $this->selected=Auth::user()->profile->interest_resiliencies->modelKeys();
        }
    }
    public function submit(){
        Auth::user()->profile->interest_resiliencies()->sync($this->selected);
        return redirect()->intended('/e2e/actions');
    }

    public function render()
    {
        $results=[];
        if($this->query!=null){
            $results=Models\Resiliency::search($this->query)->paginate(9);
        }else{
            $results=Models\Resiliency::whereRelation('categories',function(Builder $query){$query->whereIn('reliable_id',$this->categories);})->take(9)->get();
        }
        return view('livewire.e2-e.v-cs',['results'=>$results])->layout('layouts.e2e');
    }
}
