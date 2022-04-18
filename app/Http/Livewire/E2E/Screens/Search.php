<?php

namespace App\Http\Livewire\E2E\Screens;

use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use App\Models;
use Illuminate\Support\Facades\Auth;
class Search extends Component
{
    public $model;
    public $type="produce";
    public $action="buy";
    public $select="multiple";
    public $query='';
    public $perPage=10;
    public $selected=[];
    public function mount($model="item"){
        if($model=="crop"){
            $this->model="resiliency";
        }else{
            $this->model=$model;
        }
    }
    public function submit(){
        if(count($this->selected)>0){
            $profile=Auth::user()->profile;     
            if($this->model=="crop"){
                $profile->interest_resiliencies()->attach($this->selected);
                return redirect('/e2e');
            }else{
                if($this->select=="multiple"){
                    $trades=collect($this->selected)->map(function($value,$key){
                        return ["item_id"=>$value,"type"=>$this->action];
                    });
                    $trades=$profile->trades()->createMany($trades);
                    return redirect('/e2e');
                }else{
                    $trade=$profile->trades()->create(["item_id"=>$this->selected[0],"type"=>$this->action]);
                    return redirect("/e2e/bid-form"."/".$trade->id);
                }
            }
        }
        else{
            $this->addError('item', __('Select at least one item.'));
            return;
        }
    }
    public function render()
    {
        $namespace="App\\Models\\".ucfirst($this->model);
        if($this->query){
            $query=$namespace::search($this->query);
        }else{
            $query=$namespace::select('name','image_url','id');
            if($this->model=="resiliency"){
                $query=$query->whereRelation('categories','reliable_id',1);
            }
        }
        if($this->model=="item"){
            $query=$query->where("type",$this->type);
        }
        $results=$query->paginate($this->perPage);
        return view('livewire.e2-e.screens.search',["results"=>$results])->layout('layouts.e2e');
    }
}
