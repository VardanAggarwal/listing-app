<?php

namespace App\Http\Livewire\E2E;

use Livewire\Component;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
class Login extends Component
{
    public $phone_number;
    public $role='';
    protected $queryString = [
        'role'=>['except'=>'']
    ];
    protected $rules=[
        'phone_number'=>'numeric|required|digits:10'
    ];
    public function sign_in(){
        $this->validate();
        $phone_number="+91".$this->phone_number;
        $user=User::firstOrCreate(['phone_number'=>$phone_number]);
        if($user->profile){
            $profile=$user->profile;
        }else{
            $profile=Profile::firstOrCreate(['contact_number'=>$phone_number]);
            $profile->user()->associate($user);
        }
        Auth::login($user,$remember=true);
        if(in_array($this->role, ["input_provider", "farmer", "trader", "buyer"])){
            $profile->personas=$this->role;
        }
        $profile->save();
        return redirect('/e2e');
    }
    public function render()
    {
        return view('livewire.e2-e.login')->layout('layouts.e2e');
    }
}
