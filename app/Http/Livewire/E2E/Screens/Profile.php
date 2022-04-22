<?php

namespace App\Http\Livewire\E2E\Screens;

use Livewire\Component;
use App\Models;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
class Profile extends Component
{
    public Models\Profile $profile;
    public $edit=false;
    public $button="contact";
    public $allowed=false;
    public $href;
    public function mount(){
        if(Auth::user()){
            $profile=Auth::user()->profile;
            if($profile->id==$this->profile->id){
                $this->edit=true;
                $this->button="share";
            }
            if($profile->name&&$profile->pincode&&$profile->personas){
                $this->allowed=true;
            }
        }
        if($this->button=="share"){
            $this->href="https://wa.me/"."?text=".__('e2e.profile.message.share',['url'=>url('').'/e2e/profiles/'.$this->profile->id,'name'=>$this->profile->name]);
        }else{
            $this->href="https://wa.me/".Str::remove('+',$this->profile->contact_number)."?text=".__('e2e.profile.message.contact',['url'=>url('').'/e2e/profiles/'.$this->profile->id,'name'=>$this->profile->name]);
        }
    }
    public function render()
    {
        $trades=Models\Item::leftJoin('trades','items.id','=','trades.item_id')->selectRaw('distinct on (items.name,trades.type) items.name,items.image_url, trades.price,trades.quantity, trades.type, trades.updated_at')->where('trades.profile_id',$this->profile->id)->orderBy('items.name')->orderBy('trades.type')->orderByDesc('trades.updated_at')->cursorPaginate();
        return view('livewire.e2-e.screens.profile',['trades'=>$trades])->layout('layouts.e2e');
    }
}
