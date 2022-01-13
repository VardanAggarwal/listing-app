<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Story;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class CreateStory extends Component
{
    use WithFileUploads;
    public Story $story;
    public $image;
    public $selected=[];
    protected $listeners = ['updateSelected'];
    protected $rules=[
        'story.rating'=>'required|integer',
        'story.title'=>'string|required',
        'story.review'=>'string|nullable',
        'story.image_url'=>'string|nullable'
    ];
    public function mount(){
        $this->story=new Story;
        $this->story->rating=5;
    }
    public function updateSelected($selected){
        $this->selected=$selected;
    }
    public function save(){
        if($this->image){
            $this->validate([
            'image'=>'image'
            ]);
        $this->story->image_url=Storage::url($this->image->storePublicly('user/story','s3'));
        }
        $this->validate();
        $this->story->profile()->associate(Auth::user()->profile);
        $this->story->save();
        $this->story->resiliencies()->sync($this->selected);
        Auth::user()->profile->interest_resiliencies()->syncWithoutDetaching($this->selected);
        return redirect('/stories/'.$this->story->id);
    }
    public function render()
    {
        return view('livewire.create-story')->layout('layouts.guest');
    }
}
