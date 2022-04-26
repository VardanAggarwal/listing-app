<?php

namespace App\Http\Livewire\E2E\Screens;

use Livewire\Component;
use App\Models\Trade;
use Illuminate\Support\Facades\Auth;
class SupplierList extends Component
{
    public Trade $trade;
    public $myTrade;
    public $perPage=10;
    public $button="new";
    public $allowed=false;
    public function mount(){
        if(Auth::user()){
            $profile=Auth::user()->profile;
            if($profile->name&&$profile->pincode&&$profile->personas){
                $this->allowed=true;
            }
            $this->myTrade=Trade::where('profile_id',$profile->id)->where('item_id',$this->trade->item_id)->where('type',$this->trade->type)->where('trades.updated_at','>',now()->subDays(30))->where('trades.deleted_at',null)->orderByDesc('updated_at')->first();
            if($this->myTrade){
                $this->button="update";
            }
        }
    }
    public function loadMore(){
        $this->perPage+=10;
    }
    public function button_clicked(){
        if($this->button=="update"){
            return redirect("/e2e/trade/".$this->myTrade->id);
        }else if($this->allowed){
            $trade=$this->trade;
            $trade=Trade::create(["item_id"=>$trade->item_id,"type"=>$trade->type,"profile_id"=>Auth::user()->profile->id]);
            return redirect("/e2e/bid-form/".$trade->id);
        }
    }
    public function render()
    {
        $type=$this->trade->type=="sell"?"buy":"sell";
        $suppliers=Trade::where("item_id",$this->trade->item_id)->where('trades.deleted_at',null)->where("type",$type);
        if(Auth::user()){
            $suppliers=$suppliers->where("profile_id","<>",Auth::user()->profile->id);
        }
        $suppliers=$suppliers->orderByDesc('updated_at')->cursorPaginate($this->perPage);
        return view('livewire.e2-e.screens.supplier-list',["suppliers"=>$suppliers])->layout('layouts.e2e');
    }
}
