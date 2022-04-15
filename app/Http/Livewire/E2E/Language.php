<?php

namespace App\Http\Livewire\E2E;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class Language extends Component
{
    public $locale="English";
    public function setLocale($lang){
        App::setLocale($lang);
    }
    public function render()
    {
        if(App::isLocale('en')){
            $this->locale="English";
        }elseif(App::isLocale('hi')){
            $this->locale="Hindi";
        }
        return view('livewire.e2-e.language');
    }
}
