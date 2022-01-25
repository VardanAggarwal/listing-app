<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
class PhoneAuth extends Component
{
    public $phone_number;
    public $profile;
    public $show_phone=true;
    public $code=false;
    public $show_profile=false;
    public $status=null;
    protected $rules=[
        'phone_number'=>'numeric|required|digits:10',
        'profile.name'=>'sometimes|string|required',
        'profile.address'=>'sometimes|string|required',
        'profile.pincode'=>'sometimes|numeric|digits:6|required'
    ];
    public function mount(){
        $this->status=session('status');
    }
    public function sign_in(){
        $this->validate();
        $phone_number="+91".$this->phone_number;
        $user=User::firstOrCreate(['phone_number'=>$phone_number],['phone_number_verified'=>true]);
        $user->phone_number_verified=true;
        if($user->profile){
            $profile=$user->profile;
        }else{
            $profile=Profile::firstOrCreate(['contact_number'=>$phone_number]);
            $profile->user()->associate($user);
            $profile->save();
        }
        Auth::login($user,$remember=true);
        if($profile->name&&$profile->pincode){
            return redirect()->intended('/');
        }
        else{
            $this->profile=$profile;
            $this->show_profile=true;
            $this->show_phone=false;
            $this->code=false;
        }
    }
    public function profile_submit(){
        $this->validate();
        Auth::User()->name=$this->profile->name;
        $this->profile->save();
        Auth::User()->save();
        return redirect()->intended('/');
    }
    public function render()
    {
        return view('livewire.phone-auth');
    }
}
