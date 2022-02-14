<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Feed;
use App\Models;
class FeedList extends Component
{
    public $perPage = 0;
    public $cardCount = 1;
    public $loading=false;
    protected $feed;
    protected $listeners=['refreshStatement'=>'$refresh'];
    public function mount(){
    }
    public function loadMore($type='perPage')
       {
           $this->{$type} += 5;
       }
    public function render()
    {
        $feedgroup=Models\FeedGroup::where(['model'=>'Resiliency','purpose'=>'admin_pick'])->first();
        $resiliencies=Models\Resiliency::whereIn('id',$feedgroup->data['id'])->paginate($this->cardCount);
        $categories=Models\Category::whereIn('id',Models\Reliable::select('reliable_id')->where('reliable_type','App\\Models\\Category')->whereIn('resiliency_id',$feedgroup->data['id'])->distinct()->get('reliable_id'))->paginate($this->cardCount);
        $this->feed=Feed::with(['feedable','resiliency'])->orderByDesc('updated_at')->cursorPaginate($this->perPage);
        return view('livewire.feed-list',['feed'=>$this->feed,'resiliencies'=>$resiliencies,'categories'=>$categories])->layout('layouts.guest');
    }
}
