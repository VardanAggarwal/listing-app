<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Profile;
use App\Models\Resiliency;
class ExpertList extends Component
{
    public $perPage = 0;
    public $cardCount = 0;
    public $loading=false;
    public $query='';
    protected $resiliencies;
    protected $feed;
    protected $queryString = [
        'query'=>['except'=>'']
    ];
    public function mount(){
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
        $this->resiliencies=Resiliency::has('expert_profiles')->withCount(['expert_profiles','interested_profiles'])->orderByDesc('interested_profiles_count')->orderByDesc('expert_profiles_count')->paginate($this->cardCount);
        if($this->query){
            $this->feed=Profile::search($this->query)->paginate($this->perPage);
        }
        else{
            $this->feed=Profile::whereHas('expert_resiliencies')->orderByDesc('updated_at')->cursorPaginate($this->perPage);
        }
        return view('livewire.expert-list',['feed'=>$this->feed,'resiliencies'=>$this->resiliencies])->layout('layouts.guest');
    }
}
