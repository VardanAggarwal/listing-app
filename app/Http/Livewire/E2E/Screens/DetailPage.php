<?php

namespace App\Http\Livewire\E2E\Screens;

use Livewire\Component;
use App\Models\Trade;
use Illuminate\Support\Facades\Auth;
class DetailPage extends Component
{
    public Trade $trade;
    public $media;
    public function mount(){
        if($this->trade->media){
            $this->media=explode(',',$this->trade->media);
        }
    }
    public function render()
    {
        return view('livewire.e2-e.screens.detail-page')->layout('layouts.e2e');
    }
}
