<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models;
class CardGroup extends Component
{
	protected $feed=[];
	public $index;
	public $show=false;
	public $title="Recommended for you";
	public $type='Resiliency';
	public $purpose='recommended';
	public $model=null;
	public $image=null;

	public function mount(){
	}
	public function getFeed(){
		$this->feed=collect($this->feed);
		switch($this->purpose){
			case "recommended":
				$this->title=__("Recommended for you",['type'=>__('ui.models.'.Str::plural(Str::lower($this->type)))]);
				$resiliencies=null;
				if(Auth::user()){
					if(Auth::user()->profile){
						$resiliencies=Auth::user()->profile->interest_resiliencies->modelKeys();
					}
				}
				switch($this->type){
					case "Resiliency":
						$resiliency_ids=null;
						if($resiliencies){
							$categories=Models\Reliable::select('reliable_id')->where('reliable_type','App\\Models\\Category')->whereIn('resiliency_id',$resiliencies)->distinct();
							$resiliency_ids=Models\Reliable::select('resiliency_id')->where('reliable_type','App\\Models\\Category')->whereIn('reliable_id',$categories)->whereNotIn('resiliency_id',$resiliencies)->distinct()->get('resiliency_id');
						}else{
							$feedgroup=Models\FeedGroup::where(['model'=>'Resiliency','purpose'=>'admin_pick'])->first();
							if($feedgroup){
							    $resiliency_ids=$feedgroup->data['id'];
							}
						}
						if($resiliency_ids){
							$this->feed=Models\Resiliency::whereIn('id',$resiliency_ids)->where(function ($query) {
							   $query->whereNotNull('image_url')
							  ->orWhere('description','<>','');
							   })->inRandomOrder()->take(10)->get();
						}
						break;
					case "Story":
						$story_ids=null;
						if($resiliencies){
							$story_ids=Models\Reliable::select('reliable_id')->where('reliable_type','App\\Models\\Story')->whereIn('resiliency_id',$resiliencies)->distinct();
						}else{
							$feedgroup=Models\FeedGroup::where(['model'=>'Story','purpose'=>'admin_pick'])->first();
							if($feedgroup){
							    $story_ids=$feedgroup->data['id'];
							}
						}
						if($story_ids){
							$this->feed=Models\Story::whereIn('id',$story_ids)->inRandomOrder()->take(10)->get();
						}
						break;
					case "Listing":
						$listing_ids=null;
						if($resiliencies){
							$listing_ids=Models\Reliable::select('reliable_id')->where('reliable_type','App\\Models\\Listing')->whereIn('resiliency_id',$resiliencies)->distinct();
						}else{
							$feedgroup=Models\FeedGroup::where(['model'=>'Listing','purpose'=>'admin_pick'])->first();
							if($feedgroup){
							    $listing_ids=$feedgroup->data['id'];
							}
						}
						if($listing_ids){
							$this->feed=Models\Listing::whereIn('id',$listing_ids)->inRandomOrder()->take(10)->get();
						}
						break;
				}
				break;
			case "children":
				$parent=$this->model;
				$this->image=$parent->image_url?$parent->image_url:$parent->image;
				$title_stub=$parent->title?$parent->title:($parent->name?$parent->name:Str::limit($parent->statement,30));
				$this->title=__("For",['stub'=>$title_stub,'type'=>__('ui.models.'.Str::plural(Str::lower($this->type)))]);
				$child=Str::plural(Str::lower($this->type));
				$this->feed=$parent->{$child}()->withCount('interested_profiles')->orderByDesc('interested_profiles_count')->get();
				break;
			case 'latest':
				$model='App\\Models\\'.$this->type;
				$this->feed=$model::latest()->take(10)->get();
				$this->title=__("New items",['type'=>__('ui.models.'.Str::plural(Str::lower($this->type)))]);
				break;
			case 'others':
				$this->title=__("Other items",['type'=>__('ui.models.'.Str::plural(Str::lower($this->type)))]);
				$this->feed=$this->model;
				break;
		}
		if($this->feed->count()>0){
			$this->show=true;
		}else{
			$this->show=false;
		}
	}
	public function render()
	{
		return view('livewire.card-group',['feed'=>$this->feed]);
	}
}
