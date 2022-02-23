<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CustomPage extends Component
{
    public $type='Profile';
    public $purpose='recommended';
    public $parent_type=null;
    public $parent_id=null;
    public $model=null;
    protected $queryString = [
        'type'=>['except'=>''],
        'purpose'=>['except'=>''],
        'parent_type'=>['except'=>''],
        'parent_id'=>['except'=>'']
    ];
    public function render()
    {
        if($this->parent_type&&$this->parent_id){
            $this->model=
        }
        return view('livewire.custom-page')->layout('layouts.guest');
    }
}
