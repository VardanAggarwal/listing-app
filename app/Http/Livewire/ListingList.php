<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Listing;
use App\Models\Resiliency;

class ListingList extends Component
{
    public $perPage = 0;
    public $cardCount = 0;
    public $loading=false;
    public $query='';
    protected $resiliencies;
    protected $feed;
    public $others;
    protected $queryString = [
        'query'=>['except'=>'']
    ];
    public function mount(){
        $this->others=Listing::doesntHave('resiliencies')->get();
    }
    public function loadMore($type)
       {
           $this->{$type} += 5;
       }
    public function resetPage(){
        $this->reset('perPage');
    }
    public function render()
    {
        $this->resiliencies=Resiliency::has('listings')->withCount(['listings','interested_profiles'])->orderByDesc('interested_profiles_count')->orderByDesc('listings_count')->paginate($this->cardCount);
        if($this->query){
            $this->feed=Listing::search($this->query)->paginate($this->perPage);
        }
        else{
            $this->feed=Listing::with(['profile'])->orderByDesc('id')->cursorPaginate($this->perPage);
        }
        return view('livewire.listing-list',['feed'=>$this->feed,'resiliencies'=>$this->resiliencies])->layout('layouts.guest');
    }
}
