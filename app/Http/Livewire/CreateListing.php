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
        'listing.name'=>'string',
        'listing.type'=>'string',
        'listing.item_type'=>'string',
        'listing.image_url'=>'string',
        'listing.price'=>'string',
        'listing.description'=>'text',
        'listing.location'=>'string'
    ];
    public function mount(){
        $this->listing=new Listing;
        $this->listing->type="sell";
        if(Auth::user()->profile){
            $this->listing->location=Auth::user()->profile->address;
        }
        $this->listing->item_type="input";
    }
    public function updateSelected($selected){
        $this->selected=$selected;
    }
    public function save(){
        if($this->image){
            $this->validate([
            'image'=>'image'
            ]);
        $this->listing->image_url=Storage::url($this->image->storePublicly('user/listing'));
        }
        $this->listing->profile()->associate(Auth::user()->profile);
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
