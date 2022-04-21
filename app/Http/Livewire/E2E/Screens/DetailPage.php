<?php

namespace App\Http\Livewire\E2E\Screens;

use Livewire\Component;
use App\Models\Trade;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
class DetailPage extends Component
{
    public Trade $trade;
    public $media;
    public $title;
    public $button;
    public $href;
    public $allowed=false;
    public function mount(){
        $trade=$this->trade;
        if($trade->media){
            $this->media=explode(',',$trade->media);
        }
        $this->button="contact";
        if(Auth::user()){
            $profile=Auth::user()->profile;
            if($profile->name&&$profile->pincode&&$profile->personas){
                $this->allowed=true;
            }
            if($profile->id==$trade->profile_id){
                $this->button="share";
            }
        }
        if($this->button=="share"){
            $this->href="https://wa.me/"."?text=".__('e2e.trade.share_message',['url'=>url('').'/e2e/trade/'.$trade->id,'title'=>__('e2e.trade.title.'.$trade->type,['name'=>$trade->item->name])]);
        }else{
            $this->href="https://wa.me/".Str::remove('+',$trade->profile->contact_number)."?text=".__('e2e.trade.contact_message',['url'=>url('').'/e2e/profiles/'.$trade->id,'trading'=>__('e2e.trade.trading.'.$trade->type),'item'=>$trade->item->name]);
        }
        $title="";
        if($trade->price){
            $title.=__('e2e.global.units.rupees').' '.$trade->price.'/'.__('e2e.global.units.kg');
        }
        if($trade->quantity){
            $title.=', '.$trade->quantity.' '.__('e2e.global.units.kg');
        }
        $this->title=ltrim($title,', ');
    }
    public function render()
    {
        return view('livewire.e2-e.screens.detail-page')->layout('layouts.e2e');
    }
}
