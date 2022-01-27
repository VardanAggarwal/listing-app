<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Resiliency;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class CreateResiliency extends Component
{
    use WithFileUploads;
    public $type;
    public Resiliency $resiliency;
    public $image;
    public $other_names;
    public $selected=[];
    protected $listeners = ['updateSelected'];
    protected $rules=[
        'resiliency.name'=>'string|required',
        'resiliency.type'=>'string',
        'resiliency.description'=>'string|nullable',
        'resiliency.image_url'=>'string|nullable'
    ];
    public function mount($resiliency=null){
        if ($resiliency){
            $this->resiliency=$resiliency;
            $this->selected=$resiliency->categories->modelKeys();
            if($resiliency->additional_info){
                $this->other_names=$resiliency->additional_info['other_names'];
            }
        }
        else{
            $this->resiliency=new Resiliency;
            $this->resiliency->type="crop";
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
        $this->resiliency->image_url=Storage::url($this->image->storePublicly('user/resiliency','s3'));
        }
        $this->validate();
        if($this->other_names){
            $this->resiliency->additional_info=['other_names'=>$this->other_names];            
        }
        $this->resiliency->save();
        $this->resiliency->categories()->sync($this->selected);
        Auth::user()->profile->interest_resiliencies()->syncWithoutDetaching([$this->resiliency->id]);
        return redirect('/resiliencies/'.$this->resiliency->id);
    }
    public function render()
    {
        return view('livewire.create-resiliency')->layout('layouts.guest');
    }
}
