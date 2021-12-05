<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Story;
use App\Models\Resiliency;
use Livewire\WithFileUploads;
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
        'story.rating'=>'integer',
        'story.title'=>'string',
        'story.review'=>'text',
        'story.image_url'=>'string',
        'story.links'=>'string'
    ];
    public function mount(){
        $this->story=new Story;
    }
    public function toggleSelected($item){
        if(in_array($item,$this->selected)){
            $this->selected=array_diff( $this->selected, [$item] );
        }else{
        array_push($this->selected,$item);
        }        
    }
    public function save(){
        if($this->image){
            $this->validate([
            'image'=>'image'
            ]);
        $this->story->image_url=Storage::url($this->image->store('public/photos'));
        }
        $this->story->save();
        $this->story->resiliencies()->sync($this->selected);
        return redirect('/stories/'.$this->story->id);
    }
    public function render()
    {
        $this->resiliencies=Resiliency::findMany($this->selected);
        $this->results=Resiliency::search($this->search_resiliency)->get();
        return view('livewire.create-story')->layout('layouts.guest');
    }
}
