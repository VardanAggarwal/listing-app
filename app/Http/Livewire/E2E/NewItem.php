<?php

namespace App\Http\Livewire\E2E;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\Item;
class NewItem extends Component
{
    use WithFileUploads;
    public $item;
    public $image;
    protected $rules=[
        'item.name'=>'string|required',
        'image'=>'image|max:10240|nullable',
        'item.type'=>'string|required',
        'item.additional_info.scientific_name'=>"string|nullable"
    ];
    protected $listeners=['remount'=>'mount'];
    public function mount($type="produce",$name=null){
        $this->item=new Item;
        $this->item->type=$type;
        $this->item->name=$name;
    }
    public function save(){
        $this->validate();
        $item=$this->item;
        if($this->image){
        $image_url=Storage::url($this->image->storePublicly('user/item','s3'));
        $item->image_url=$image_url;
        }
        $item->save();
        $this->emit('addToSelected',$item->id);
    }
    public function render()
    {
        return view('livewire.e2-e.new-item')->layout('layouts.e2e');
    }
}
