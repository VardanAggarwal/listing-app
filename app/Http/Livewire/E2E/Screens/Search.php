<?php

namespace App\Http\Livewire\E2E\Screens;

use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
class Search extends Component
{
    public $type;
    public $action;
    public $select;
    public $query='';
    public $perPage=10;
    public $selected=[];
    public function mount($select,$type,$action){
        $this->type=$type;
        $this->action=$action;
        $this->select=$select;
    }
    public function submit(){
        if(count($this->selected)>0){
            $profile=Auth::user()->profile;  
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
        else{
            $this->addError('item', __('Select at least one item.'));
            return;
        }
    }
    public function render()
    {
        if($this->query){
            $query=Item::search($this->query);
        }else{
            $query=Item::where("type",$this->type);
        }
        $results=$query->paginate($this->perPage);
        return view('livewire.e2-e.screens.search',["results"=>$results])->layout('layouts.e2e');
    }
}
