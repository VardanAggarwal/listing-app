<?php

namespace App\Http\Livewire\E2E\Screens;

use Livewire\Component;
use App\Models\Trade;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Notifications\RequestDetails;
class DetailPage extends Component
{
    public Trade $trade;
    public $media;
    public $title;
    public $button;
    public $href;
    public $call;
    public $requestSent;
    public $allowed=false;
    public function mount(){
        $trade=$this->trade;
        if($trade->media){
            $this->media=explode(',',$trade->media);
        }
        if($this->trade->profile->contact_number){
            $this->call='tel:'.$this->trade->profile->contact_number;
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
        }elseif($trade->profile->contact_number){
            $this->call='tel:'.$trade->profile->contact_number;
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
    public function sendRequest(){
        $name=__('e2e.global.generic_user');
        if(Auth::user()){
            $name=Auth::user()->name;
        }
        $this->trade->profile->notify(new  RequestDetails($this->trade->id,$name));
        $this->requestSent=true;
    }
    public function delete(){
        $this->trade->delete();
        return redirect('/e2e/profiles/'.Auth::user()->profile->id);
    }
    public function render()
    {
        return view('livewire.e2-e.screens.detail-page')->layout('layouts.e2e');
    }
}
