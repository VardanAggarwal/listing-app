<?php

namespace App\Http\Livewire\E2E;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class ProfileCheck extends Component
{
    public $allowed=false;
    public $url;
    public function mount(){
        $this->url=url()->full();
        if(Auth::user()){
            $profile=Auth::user()->profile;
            if($profile->name&&$profile->pincode&&$profile->personas){
                $this->allowed=true;
            }
        }
    }
    public function saveUrl(){
        session()->put('profileCheckUrl',$this->url);
        return redirect("/e2e/profile/edit");
    }
    public function render()
    {
        return view('livewire.e2-e.profile-check');
    }
}
