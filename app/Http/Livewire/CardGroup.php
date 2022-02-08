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
		$resiliencies=null;
		if(Auth::user()){
			if(Auth::user()->profile){
				$resiliencies=Auth::user()->profile->interest_resiliencies->modelKeys();
			}
		}
		switch($this->type){
			case "Resiliency":
				if($resiliencies){
					$categories=Models\Reliable::select('reliable_id')->where('reliable_type','App\\Models\\Category')->whereIn('resiliency_id',$resiliencies)->distinct();
					$resiliency_ids=Models\Reliable::select('resiliency_id')->where('reliable_type','App\\Models\\Category')->whereIn('reliable_id',$categories)->whereNotIn('resiliency_id',$resiliencies)->distinct()->get('resiliency_id');
					if($resiliency_ids){
						$this->feed=Models\Resiliency::whereIn('id',$resiliency_ids)->where(function ($query) {
						   $query->whereNotNull('image_url')
						  ->orWhere('description','<>','');
						   })->inRandomOrder()->take(10)->get();
						$this->show=true;
					}else{
						$this->show=false;        
					}
				}else{
					$this->show=false;
				}
				break;
			case "Story":
				if($resiliencies){
					$story_ids=Models\Reliable::select('reliable_id')->where('reliable_type','App\\Models\\Story')->whereIn('resiliency_id',$resiliencies)->distinct()->get('reliable_id');
					$this->feed=Models\Story::whereIn('id',$story_ids)->where(function ($query) {
						   $query->whereNotNull('image_url')
						  ->orWhere('review','<>','');
						   })->inRandomOrder()->take(10)->get();
					$this->show=true;
				}else{
					$this->show=false;   
				}
				break;
			case "Listing":
				if($resiliencies){
					$listing_ids=Models\Reliable::select('reliable_id')->where('reliable_type','App\\Models\\Listing')->whereIn('resiliency_id',$resiliencies)->distinct()->get('reliable_id');
					$this->feed=Models\Listing::whereIn('id',$listing_ids)->where(function ($query) {
						   $query->whereNotNull('image_url')
						  ->orWhere('description','<>','');
						   })->inRandomOrder()->take(10)->get();
					$this->show=true;
				}else{
					$this->show=false;   
				}
				break;
		}
	}
	public function render()
	{
		return view('livewire.card-group',['feed'=>$this->feed]);
	}
}
