<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resiliency;
use Illuminate\Support\Facades\Auth;
use App\Models;
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
    public function destroy(Resiliency $resiliency){
        if(Auth::user()){
            if(Auth::user()->role_id==1){
                Models\Feed::where('feedable_type','App\\Models\\Resiliency')->where('feedable_id',$resiliency->id)->delete();
                Models\Reliable::where('resiliency_id',$resiliency->id)->delete();
                Models\Interestable::where('interestable_type','App\\Models\\Resiliency')->where('interestable_id',$resiliency->id)->delete();
                Models\Attachable::where('attachable_type','App\\Models\\Resiliency')->where('attachable_id',$resiliency->id)->delete();
                foreach($resiliency->statements as $statement){
                    $statement->stateable()->dissociate();
                }
                $resiliency->delete();
                return redirect('/resiliencies');
            }
        }
        return redirect('/resiliencies/'.$resiliency->id);
    }
    //
}
