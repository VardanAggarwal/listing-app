<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models;
class CardGroup extends Component
{
    protected $feed=[];
    public $index;
    public $show=false;
    public $title="Recommended for you";
    public $type='Resiliency';

    public function mount(){
    }
    public function getFeed(){
        $resiliency_ids=null;
        if(Auth::user()){
            if(Auth::user()->profile){
                $resiliencies=Auth::user()->profile->interest_resiliencies->modelKeys();
                $categories=Models\Reliable::select('reliable_id')->where('reliable_type','App\\Models\\Category')->whereIn('resiliency_id',$resiliencies)->distinct();
                $resiliency_ids=Models\Reliable::select('resiliency_id')->where('reliable_type','App\\Models\\Category')->whereIn('reliable_id',$categories)->whereNotIn('resiliency_id',$resiliencies)->distinct()->get('resiliency_id');
            }
        }
        switch($this->type){
            case "Resiliency":
                if($resiliency_ids){
                    $this->feed=Models\Resiliency::whereIn('id',$resiliency_ids)->where('image_url','<>',null)->orWhere('description','<>',null)->inRandomOrder()->take(10)->get();
                    $this->show=true;
                }else{
                    $this->show=false;
                }
                break;
            case "Story":
                break;
            case "Listing":
                break;
        }
    }
    public function render()
    {
        return view('livewire.card-group',['feed'=>$this->feed]);
    }
}
