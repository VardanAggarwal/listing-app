<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Models\Statement;
use Illuminate\Support\Facades\Storage;
class PostStatement extends Component
{
    use WithFileUploads;
    public $saved=false;
    public $statement="";
    public $media=[];
    public $selected=[];
    public $parent;
    protected $listeners = ['updateSelected'];
    protected $rules=[
        'statement'=>'string|required'
    ];
    public function updateSelected($selected){
        $this->selected=$selected;
    }
    public function removePhoto($index){
        $this->media=array_diff( $this->media, [$this->media[$index]] );
    }
    public function resetErrors(){
        $this->resetErrorBag();
    }
    public function save_statement(){
        if(Auth::user()){
            $this->validate();
            $statement=New Statement;
            $statement->statement=$this->statement;
            $statement->profile()->associate(Auth::user()->profile);
            $media=collect([]);
            foreach ($this->media as $photo) {
                       $media->push(Storage::url($photo->storePublicly('user/statement')));
                   }
            $statement->media=trim($media->reduce(function($string,$url){
                return $string.",".$url;
            },""),',');
            if($this->parent){
                $statement->stateable()->associate($this->parent);
            }
            $statement->save();
            $statement->attached_resiliencies()->sync($this->selected);
            $this->saved=true;
            $this->selected=[];
            $this->media=[];

        }else{
            return redirect()->guest('login')->with('status', 'Please login to perform this action');
        }
    }
    public function render()
    {
        return view('livewire.post-statement');
    }
}
