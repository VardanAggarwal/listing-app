<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Resiliency;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
class CreateResiliency extends Component
{
    use WithFileUploads;
    public $type;
    public Resiliency $resiliency;
    public $image;
    protected $rules=[
        'resiliency.name'=>'string',
        'resiliency.type'=>'string',
        'resiliency.description'=>'text',
        'resiliency.image_url'=>'string',
        'resiliency.links'=>'string'
    ];
    public function mount(Request $request){
        $this->resiliency=new Resiliency;
    }
    public function save(){
        if($this->image){
            $this->validate([
            'image'=>'image'
            ]);
        $this->resiliency->image_url=Storage::url($this->image->store('public/photos'));
        }
        $this->resiliency->save();
        return redirect('/resiliencies/'.$this->resiliency->id);
    }
    public function render()
    {
        return view('livewire.create-resiliency')->layout('layouts.guest');
    }
}
