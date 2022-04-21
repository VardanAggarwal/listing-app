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
    public $newItem=false;
    public $query='';
    public $perPage=10;
    public $selected=[];
    protected $listeners=['addToSelected'];
    public function mount($select,$type,$action){
        $this->type=$type;
        $this->action=$action;
        $this->select=$select;
    }
    public function loadMore(){
        $this->perPage+=10;
    }
    public function addToSelected($item){
        array_push($this->selected,$item);
        $this->newItem=false;
    }
    public function submit(){
        if(count($this->selected)>0){
            $profile=Auth::user()->profile;  
            if($this->select=="multiple"){
                $trades=collect($this->selected)->map(function($value,$key){
                    return ["item_id"=>$value,"type"=>$this->action];
                });
                $trades=$profile->trades()->createMany($trades);
                return redirect('/e2e/profiles/'.$profile->id);
            }else{
                $trade=$profile->trades()->create(["item_id"=>$this->selected[0],"type"=>$this->action]);
                return redirect("/e2e/bid-form"."/".$trade->id);
            }
        }
        else{
            $this->addError('item', __('e2e.search.error_text'));
            return;
        }
    }
    public function render()
    {
        if($this->query){
            $query=Item::search($this->query)->where("type",$this->type);
        }else{
            $query=Item::where("type",$this->type)->withCount('trades')->orderByDesc('trades_count');
        }
        $results=$query->paginate($this->perPage);
        return view('livewire.e2-e.screens.search',["results"=>$results])->layout('layouts.e2e');
    }
}
