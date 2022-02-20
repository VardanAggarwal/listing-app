<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Feed;
use App\Models;
class FeedList extends Component
{
    public $perPage = 0;
    public $cardCount = 1;
    public $load=false;
    protected $listeners=['refreshStatement'=>'$refresh'];
    public function getFeed(){
        $this->load=true;
    }
    public function loadMore($type='perPage')
       {
           $this->{$type} += 1;
       }
    public function render()
    {
        $feedgroup=Models\FeedGroup::where(['model'=>'Resiliency','purpose'=>'admin_pick'])->first();
        $resiliencies=Models\Resiliency::whereIn('id',$feedgroup->data['id'])->paginate($this->cardCount);
        return view('livewire.feed-list',['resiliencies'=>$resiliencies])->layout('layouts.guest');
    }
}
