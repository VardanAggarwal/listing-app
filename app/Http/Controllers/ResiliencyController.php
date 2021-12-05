<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resiliency;
use App\Http\Livewire\CreateResiliency;

class ResiliencyController extends Controller
{
    public function show(Resiliency $resiliency){
        $resiliency->loadCount(['listings','stories'])->load(['listings','stories']);
        return view('resiliency',['resiliency'=>$resiliency]);
    }
    public function createCrop(){
        return (CreateResiliency::class);
    }
    //
}
