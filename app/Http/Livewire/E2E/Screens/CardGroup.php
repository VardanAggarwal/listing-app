<?php

namespace App\Http\Livewire\E2E\Screens;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models;
class CardGroup extends Component
{
    public $action;
    public $role;
    public $perPage=10;
    public $days=30;
    protected $listeners=['navigate'];
    public function mount(){
        if(Auth::user()){
            if(Auth::user()->profile->personas){
                $this->role=Auth::user()->profile->personas;
            }
        }
    }
    public function navigate($action){
        $this->action=$action;
    }
    public function loadMore(){
        $this->perPage+=10;
    }
    public function render()
    {
        switch($this->role){
            case "input_provider":
                if($this->action=="sell"){
                    $query=Models\Item::leftJoin('trades','items.id','=','trades.item_id')->selectRaw('distinct on (items.name) items.name,items.image_url, trades.price, trades.updated_at')->where('trades.type','sell')->where('items.type','input')->where('trades.profile_id',Auth::user()->profile->id)->orderBy('items.name')->orderByDesc('trades.updated_at');
                    $type="trade";
                    $item_type="input";
                }
                break;
            case "farmer":
                if($this->action=="buy"){
                    $query=Models\Item::leftJoin('trades','items.id','=','trades.item_id')->selectRaw('items.name,items.image_url, min(trades.price::DECIMAL), max(trades.price::DECIMAL), count(distinct(trades.profile_id))')->where('trades.type','sell')->where('items.type','input')->where('trades.updated_at','>',now()->subDays($this->days))->groupBy('items.id','items.name','items.image_url');
                    $type="item";
                    $item_type="input";
                }
                if($this->action=="sell"){
                    $query=Models\Item::leftJoin('trades','items.id','=','trades.item_id')->selectRaw('items.name,items.image_url, min(trades.price::DECIMAL), max(trades.price::DECIMAL), count(distinct(trades.profile_id))')->where('trades.type','buy')->where('items.type','produce')->where('trades.updated_at','>',now()->subDays($this->days))->groupBy('items.id','items.name','items.image_url');
                    $type="item";
                    $item_type="produce";
                }
                break;
            case "trader":
                if($this->action=="buy"){
                    $query=Models\Item::leftJoin('trades','items.id','=','trades.item_id')->selectRaw('items.name,items.image_url, min(trades.price::DECIMAL), max(trades.price::DECIMAL), count(distinct(trades.profile_id))')->where('trades.type','sell')->where('items.type','produce')->where('trades.updated_at','>',now()->subDays($this->days))->groupBy('items.id','items.name','items.image_url');
                    $type="item";
                    $item_type="produce";
                }
                if($this->action=="sell"){
                    $query=Models\Item::leftJoin('trades','items.id','=','trades.item_id')->selectRaw('items.name,items.image_url, min(trades.price::DECIMAL), max(trades.price::DECIMAL), count(distinct(trades.profile_id))')->where('trades.type','buy')->where('items.type','produce')->where('trades.updated_at','>',now()->subDays($this->days))->groupBy('items.id','items.name','items.image_url');
                    $type="item";
                    $item_type="produce";    
                }
                break;
            case "buyer":
                if($this->action=="buy"){
                    $query=Models\Item::leftJoin('trades','items.id','=','trades.item_id')->selectRaw('items.name,items.image_url, min(trades.price::DECIMAL), max(trades.price::DECIMAL), count(distinct(trades.profile_id))')->where('trades.type','sell')->where('items.type','produce')->where('trades.updated_at','>',now()->subDays($this->days))->groupBy('items.id','items.name','items.image_url');
                    $type="item";
                    $item_type="produce";
                }
                break;
        }
        if($query){
            $items=$query->cursorPaginate($this->perPage);
        }
        return view('livewire.e2-e.screens.card-group',["items"=>$items,"type"=>$type,"item_type"=>$item_type]);
    }
}