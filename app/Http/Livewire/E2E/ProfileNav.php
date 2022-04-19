<?php

namespace App\Http\Livewire\E2E;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class ProfileNav extends Component
{
    public $redirect="";
    public function mount(){
        if(Auth::user()->profile->name&&Auth::user()->profile->pincode){
            $this->redirect="/e2e/profiles/".Auth::user()->profile->id;
        }else{
            $this->redirect="/e2e/profile/edit";
        }
    }
    public function render()
    {
        return view('livewire.e2-e.profile-nav');
    }
}
