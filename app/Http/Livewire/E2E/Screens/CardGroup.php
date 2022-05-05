<?php

namespace App\Http\Livewire\E2E\Screens;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models;
class CardGroup extends Component
{
    public $action;
    public $role;
    public $perPage=10;
    public $days=30;
    public $allowed=false;
    protected $listeners=['navigate'];
    public function mount(){
        if(Auth::user()){
            $profile=Auth::user()->profile;
            if($profile->personas){
                $this->role=$profile->personas;
            }
            if($profile->name&&$profile->pincode){
                $this->allowed=true;
            }
        }
    }
    public function navigate($action){
        $this->action=$action;
    }
    public function loadMore(){
        $this->perPage+=10;
    }
    public function supplierClicked($type,$id){
        $profile=Auth::user()->profile;
        if($type=="trade"){
            $trade=Models\Trade::find($id);
            return redirect('/e2e/supplier-list/'.$id);
        }else{
            $trade=Models\Trade::where('type',$this->action)->where('item_id',$id)->where('trades.profile_id',$profile->id)->orderByDesc('updated_at')->first();
            if($trade){
                return redirect('/e2e/supplier-list/'.$trade->id);
            }
            $trade=Models\Trade::where('type',$this->action)->where('item_id',$id)->orderByDesc('updated_at')->first();
            if($trade){
              return redirect('/e2e/supplier-list/'.$trade->id);  
            }
            $trade=Auth::user()->profile->trades()->create(["item_id"=>$id,"type"=>$this->action]);
            return redirect('/e2e/bid-form/'.$trade->id);
        }
    }
    public function actionClicked($type,$id){
        $profile=Auth::user()->profile;
        if($type=="trade"){
            $trade=Models\Trade::find($id);
            if($trade->profile_id==$profile->id){
                return redirect('/e2e/trade/'.$id);
            }else{
                $id=$trade->item_id;
            }
        }
        $trade=Auth::user()->profile->trades()->create(["item_id"=>$id,"type"=>$this->action]);
            return redirect("/e2e/bid-form"."/".$trade->id);
    }
    public function render()
    {
        switch($this->role){
            case "input_provider":
                if($this->action=="sell"){
                    $query=Models\Item::join('trades','items.id','=','trades.item_id')->selectRaw('items.name,items.image_url, trades.price, trades.updated_at,trades.id as id')->where('trades.deleted_at',null)->where('trades.type','sell')->where('items.type','input')->where('trades.profile_id',Auth::user()->profile->id)->orderByDesc('trades.updated_at');
                    $type="trade";
                    $item_type="input";
                }
                break;
            case "farmer":
                if($this->action=="buy"){
                    $trade_type="sell";
                    $type="item";
                    $item_type="input";
                }
                if($this->action=="sell"){
                    $trade_type="buy";
                    $type="item";
                    $item_type="produce";
                }
                break;
            case "trader":
                if($this->action=="buy"){
                    $trade_type="sell";
                    $type="item";
                    $item_type="produce";
                }
                if($this->action=="sell"){
                    $trade_type="buy";
                    $type="item";
                    $item_type="produce";    
                }
                break;
            case "buyer":
                if($this->action=="buy"){
                    $trade_type="sell";
                    $type="item";
                    $item_type="produce";
                }
                break;
        }
        if($type=="item"){
            $trades=Models\Item::join('trades','items.id','=','trades.item_id')->selectRaw('items.id,items.name,items.image_url,trades.*')->where('trades.type',$trade_type)->where('trades.deleted_at',null)->where('items.type',$item_type)->where('trades.updated_at','>',now()->subDays($this->days))->orderByDesc('trades.updated_at');
            $query=DB::table($trades,'trades')->selectRaw('name,image_url,max(updated_at) as date, min(price::DECIMAL), max(price::DECIMAL), count(distinct(profile_id)), item_id as id')->groupBy('item_id','name','image_url')->orderByDesc('date');
        }
        if($query){
            $items=$query->cursorPaginate($this->perPage);
        }
        return view('livewire.e2-e.screens.card-group',["items"=>$items,"type"=>$type,"item_type"=>$item_type]);
    }
}