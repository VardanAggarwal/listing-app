<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
class CreateCategory extends Component
{
    public Category $category;
    public $selected=[];
    protected $listeners = ['updateSelected'];
        protected $rules=[
        'category.name'=>'string|required'
    ];
    public function mount($category=null){
        if($category){
            $this->category=$category;
            $this->selected=$category->resiliencies->modelKeys();
        }else{
            $this->category=new Category;
        }
    }
    public function updateSelected($selected){
        $this->selected=$selected;
    }
    public function save(){
        $this->category->save();
        $this->category->resiliencies()->sync($this->selected);
        return redirect('/categories/'.$this->category->id);
    }
    public function render()
    {
        return view('livewire.create-category')->layout('layouts.guest');
    }
}
