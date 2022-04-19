<?php

namespace App\Http\Livewire\E2E\Screens;

use Livewire\Component;
use App\Models;
use Illuminate\Support\Facades\Auth;
class Profile extends Component
{
    public Models\Profile $profile;
    public $edit=false;
    public function mount(){
        if(Auth::user()->id==$this->profile->user_id){
            $this->edit=true;
        }
    }
    public function render()
    {
        $trades=Models\Item::leftJoin('trades','items.id','=','trades.item_id')->selectRaw('distinct on (items.name,trades.type) items.name,items.image_url, trades.price,trades.quantity, trades.type, trades.updated_at')->where('trades.profile_id',$this->profile->id)->orderBy('items.name')->orderBy('trades.type')->orderByDesc('trades.updated_at')->cursorPaginate();
        return view('livewire.e2-e.screens.profile',['trades'=>$trades])->layout('layouts.e2e');
    }
}
