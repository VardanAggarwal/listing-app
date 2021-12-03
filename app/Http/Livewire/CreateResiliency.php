<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Crop;
use App\Models\Resiliency;
use App\Models\Agrimodel;
use App\Models\Practice;
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
        'resiliency.description'=>'text',
        'resiliency.image'=>'string',
        'resiliency.links'=>'string'
    ];
    public function mount(Request $request){
        $this->type=Str::singular(Str::replace('/new','',$request->path()));
        $this->resiliency=new Resiliency;
    }
    public function save(){
        if($this->image){
            $this->validate([
            'image'=>'image'
            ]);
        $this->resiliency->image=Storage::url($this->image->store('public/photos'));
        }
        switch ($this->type) {
            case 'crop':
                $resilient=new Crop;
                break;
            case 'agrimodel':
                $resilient=new Agrimodel;
                break;
            case 'practice':
                $resilient=new Practice;
                break;
        }
        $resilient->save();
        $this->resiliency->resilient_id=$resilient->id;
        $this->resiliency->resilient_type='App\\Models\\'.$this->type;
        $resiliency=$this->resiliency->save();
        return redirect('/'.Str::lower(Str::plural($this->type)).'/'.$resilient->id);
    }
    public function render()
    {
        return view('livewire.create-resiliency',['type'=>$this->type])->layout('layouts.guest');
    }
}
