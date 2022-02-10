<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Listing;
use Illuminate\Support\Facades\Auth;
use App\Models\Resiliency;

class ListingList extends Component
{
    public $perPage = 10;
    public $loading=false;
    public $query='';
    public $resiliencies;
    protected $feed;
    protected $queryString = [
        'query'=>['except'=>'']
    ];
    public function mount(){
        $this->resiliencies=Resiliency::has('listings')->withCount(['listings','interested_profiles'])->orderByDesc('listings_count')->orderByDesc('interested_profiles_count')->get();
    }
    public function loadMore()
       {
           $this->perPage += 10;
       }
    public function resetPage(){
        $this->reset('perPage');
    }
    public function render()
    {
        if($this->query){
            $this->feed=Listing::search($this->query)->paginate($this->perPage);
        }
        else{
            $this->feed=Listing::with(['profile'])->orderByDesc('id')->cursorPaginate($this->perPage);
        }
        return view('livewire.listing-list',['feed'=>$this->feed])->layout('layouts.guest');
    }
}
