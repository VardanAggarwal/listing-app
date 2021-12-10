<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Resiliency;
use App\Models\Category;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class CreateResiliency extends Component
{
    use WithFileUploads;
    public $type;
    public Resiliency $resiliency;
    public $image;
    public $categories;
    public $selected=[];
    public $search_category;
    protected $rules=[
        'resiliency.name'=>'string',
        'resiliency.type'=>'string',
        'resiliency.description'=>'text',
        'resiliency.image_url'=>'string'
    ];
    public function mount(Request $request){
        $this->resiliency=new Resiliency;
        $this->resiliency->type="crop";
        $this->results=Category::all();
    }
    public function toggleSelected($item){
        if(in_array($item,$this->selected)){
            $this->selected=array_diff( $this->selected, [$item] );
        }else{
        array_push($this->selected,$item);
        }        
    }
    public function newCategory(){
        $category=Category::create(['name'=>$this->search_category]);
        $this->search_category='';
        array_push($this->selected,$category->id);
    }
    public function save(){
        if($this->image){
            $this->validate([
            'image'=>'image'
            ]);
        $this->resiliency->image_url=Storage::url($this->image->store('public/photos'));
        }
        $this->resiliency->save();
        $this->resiliency->categories()->sync($this->selected);
        Auth::user()->profile->interest_resiliencies()->attach([$this->resiliency->id]);
        return redirect('/resiliencies/'.$this->resiliency->id);
    }
    public function render()
    {
        $this->categories=Category::findMany($this->selected);
        $this->results=Category::search($this->search_category)->get();
        return view('livewire.create-resiliency')->layout('layouts.guest');
    }
}
