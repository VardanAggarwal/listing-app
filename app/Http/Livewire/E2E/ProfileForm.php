<?php

namespace App\Http\Livewire\E2E;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
class ProfileForm extends Component
{
    use WithFileUploads;
    public $roles=["input_provider", "farmer", "trader", "buyer"];
    public $role;
    public $lang;
    public $profile;
    public $image;
    protected $rules=[
        'profile.name'=>'required|string',
        'profile.address'=>'required|string',
        'profile.pincode'=>'required|numeric|digits:6',
        'profile.additional_info.business_id'=>'string|sometimes|nullable',
        'profile.additional_info.landholding'=>'string|sometimes|nullable',
        'profile.personas'=>'required|string',
        'image'=>'image|max:10240|nullable'
    ];
    public function mount(){
        $this->lang=App::currentLocale();
        if(Auth::user()){
            $this->profile=Auth::user()->profile;
            if(isset(Auth::user()->profile->personas)){
                $this->role=Auth::user()->profile->personas;
            }
        }
    }
    public function submit(){
        $this->validate();
        if($this->image){
            $url=Storage::path($this->image->storePublicly('profile-photos','s3'));
            Auth::User()->profile_photo_path=$url;    
        }
        Auth::User()->name=$this->profile->name;
        $this->profile->save();
        Auth::User()->save();
        session()->put('locale',$this->lang);
        App::setLocale($this->lang);
        if(session()->has('profileCheckUrl')){
            return redirect(session()->get('profileCheckUrl'));
        }
        return redirect('/e2e/profiles/'.$this->profile->id);
    }
    public function render()
    {
        return view('livewire.e2-e.profile-form')->layout('layouts.e2e');
    }
}
