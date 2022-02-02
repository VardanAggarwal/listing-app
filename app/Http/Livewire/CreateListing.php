<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Listing;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class CreateListing extends Component
{
    use WithFileUploads;
    public $type;
    public Listing $listing;
    public $image;

    public $selected=[];
    protected $listeners = ['updateSelected'];
    public $item_types=['input','machinery','animal','seed','produce','training','contract_farming'];
    protected $rules=[
        'listing.name'=>'string|required',
        'listing.type'=>'string',
        'listing.item_type'=>'string',
        'listing.image_url'=>'string|nullable',
        'listing.phone_number'=>'string|required',
        'listing.price'=>'string|nullable',
        'listing.description'=>'string|nullable',
        'listing.location'=>'string|required'
    ];
    public function mount($listing=null){
        if($listing){
            if(Auth::user()->role_id==1 || Auth::user()->profile->id==$listing->profile_id){
                $this->listing=$listing;
                $this->selected=$listing->resiliencies->modelKeys();
            }else{
                return redirect('/listings/'.$listing->id);
            }
        }
        else{
            $this->listing=new Listing;
            $this->listing->type="sell";
            if(Auth::user()->profile){
                $this->listing->location=Auth::user()->profile->address;
                $this->listing->phone_number=Auth::user()->profile->contact_number;
                $this->listing->profile()->associate(Auth::user()->profile);
            }
            $this->listing->item_type="input";
        }
    }
    public function updateSelected($selected){
        $this->selected=$selected;
    }
    public function save(){
        if($this->image){
            $this->validate([
            'image'=>'image'
            ]);
        $this->listing->image_url=Storage::url($this->image->storePublicly('user/listing','s3'));
        }
        $this->validate();
        $this->listing->save();
        $this->listing->resiliencies()->sync($this->selected);
        Auth::user()->profile->interest_resiliencies()->syncWithoutDetaching($this->selected);
        return redirect('/listings/'.$this->listing->id);
    }
    public function render()
    {
        return view('livewire.create-listing')->layout('layouts.guest');
    }
}
