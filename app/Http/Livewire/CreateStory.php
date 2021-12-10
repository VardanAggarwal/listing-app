<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Story;
use App\Models\Resiliency;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class CreateStory extends Component
{
    use WithFileUploads;
    public $type;
    public Story $story;
    public $image;
    public $results;
    public $resiliencies;
    public $selected=[];
    public $search_resiliency;
    protected $rules=[
        'story.rating'=>'required|integer',
        'story.title'=>'string',
        'story.review'=>'text',
        'story.image_url'=>'string'
    ];
    public function mount(){
        $this->story=new Story;
        $this->story->rating=0;
    }
    public function toggleSelected($item){
        if(in_array($item,$this->selected)){
            $this->selected=array_diff( $this->selected, [$item] );
        }else{
        array_push($this->selected,$item);
        }        
    }
    public function newResiliency(){
        $resiliency=Resiliency::create(['name'=>$this->search_resiliency]);
        $this->search_resiliency='';
        array_push($this->selected,$resiliency->id);
    }
    public function save(){
        if($this->image){
            $this->validate([
            'image'=>'image'
            ]);
        $this->story->image_url=Storage::url($this->image->store('public/photos'));
        }
        $this->validate([
            'story.rating'=>'required|integer'
        ]);
        $this->story->profile()->associate(Auth::user()->profile);
        $this->story->save();
        $this->story->resiliencies()->sync($this->selected);
        Auth::user()->profile->interest_resiliencies()->attach($this->selected);
        return redirect('/stories/'.$this->story->id);
    }
    public function render()
    {
        $this->resiliencies=Resiliency::findMany($this->selected);
        $this->results=Resiliency::search($this->search_resiliency)->get();
        return view('livewire.create-story')->layout('layouts.guest');
    }
}
