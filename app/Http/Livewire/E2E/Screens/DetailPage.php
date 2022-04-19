<?php

namespace App\Http\Livewire\E2E\Screens;

use Livewire\Component;
use App\Models\Trade;
use Illuminate\Support\Facades\Auth;
class DetailPage extends Component
{
    public Trade $trade;
    public $media;
    public $button;
    public function mount(){
        if($this->trade->media){
            $this->media=explode(',',$this->trade->media);
        }
        $this->button="Contact Supplier";
        if(Auth::user()){
            if(Auth::user()->profile->id==$this->trade->profile_id){
                $this->button="Share on whatsapp";
            }
        }
    }
    public function render()
    {
        return view('livewire.e2-e.screens.detail-page')->layout('layouts.e2e');
    }
}
