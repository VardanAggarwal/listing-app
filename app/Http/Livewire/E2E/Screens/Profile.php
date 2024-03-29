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
    public $call;
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
            $dynamicLinks = app('firebase.dynamic_links');
            $url = url('').'/e2e/profiles/'.$this->profile->id;
            $parameters = [
                'dynamicLinkInfo' => [
                    'link' => $url,
                    'androidInfo'=> [
                        'androidPackageName'=> 'com.ssc.seedsavers'
                    ],
                ],
            ];
            $link = $dynamicLinks->createShortLink($parameters);
            $this->href="https://wa.me/"."?text=".__('e2e.profile.message.share',['url'=>$link,'name'=>$this->profile->name]);
        }elseif($this->profile->contact_number){
            $this->call='tel:'.$this->profile->contact_number;
            $this->href="https://wa.me/".Str::remove('+',$this->profile->contact_number)."?text=".__('e2e.profile.message.contact',['url'=>url('').'/e2e/profiles/'.$this->profile->id,'name'=>$this->profile->name]);
        }
    }
    public function render()
    {
        $trades=Models\Item::leftJoin('trades','items.id','=','trades.item_id')->where('trades.deleted_at',null)->where('trades.profile_id',$this->profile->id)->orderByDesc('trades.updated_at')->cursorPaginate();
        return view('livewire.e2-e.screens.profile',['trades'=>$trades])->layout('layouts.e2e');
    }
}
