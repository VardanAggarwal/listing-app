<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Resiliency;
use App\Models\Story;
use App\Models\Listing;
use App\Models\Statement;
use App\Models\Category;
use App\Models\Profile;
use Illuminate\Support\Str;
use App\Models\Interestable;
use Illuminate\Support\Facades\DB;
class Analytics extends Component
{
    public function render()
    {
        $counts=[];
        $counts['resiliencies']=Resiliency::count();
        $counts['stories']=Story::has('resiliencies')->count();
        $counts['listings']=Listing::has('resiliencies')->count();
        $counts['statements']=Statement::has('attached_resiliencies')->count();
        $vc_category=DB::table('reliables')->where('reliable_type','App\\Models\\Category')->count();
        $category=Category::count();
        $counts['VCs/category']=$vc_category/$category;
        $vc_story=DB::table('reliables')->where('reliable_type','App\\Models\\Story')->count();
        $vc_statement=DB::table('attachables')->where('attachable_type','App\\Models\\Resiliency')->count();
        $counts['posts/VC']=($vc_story+$vc_statement)/$counts['resiliencies'];
        $vc_listing=DB::table('reliables')->where('reliable_type','App\\Models\\Listing')->count();
        $counts['listings/VC']=$vc_listing/$counts['resiliencies'];
        $counts['users']=Profile::count();
        $counts['users_interested_in_resiliencies']=Profile::has('interest_resiliencies')->count();
        $counts['users_interested_in_listings']=Profile::has('interest_listings')->count();
        $counts['users_interested_in_information']=Profile::has('interest_stories')->orHas('interest_statements')->count();
        $interest_resiliencies=DB::table('interestables')->where('interestable_type','App\\Models\\Resiliency')->count();
        $interest_listings=DB::table('interestables')->where('interestable_type','App\\Models\\Listing')->count();
        $interest_information=DB::table('interestables')->where('interestable_type','App\\Models\\Story')->orWhere('interestable_type','App\\Models\\Statement')->count();
        $counts['VCs/user']=$interest_resiliencies/$counts['users_interested_in_resiliencies'];
        $counts['Listings/user']=$interest_listings/$counts['users_interested_in_listings'];
        $counts['Information/user']=$interest_information/$counts['users_interested_in_information'];
        $counts['Profiles with phone number']=Profile::where('contact_number','<>',null)->count();
        $interests = [];
        $interests['input']=Interestable::whereJsonContains('interest->interests','input');
        $interests['market']=Interestable::whereJsonContains('interest->interests','market');
        $interests['training']=Interestable::whereJsonContains('interest->interests','training');
        $interests['logistics']=Interestable::whereJsonContains('interest->interests','logistics');
        $interests['payment']=Interestable::whereJsonContains('interest->interests','payment');
        $interests['connect']=Interestable::whereJsonContains('interest->interests','connect');

        $interests['others']=Interestable::where('interest->others','<>','');
        foreach($interests as $key=>$value){
            if($key=="others"){
                $interests[$key]=$value->select('interest->others as others','interestable_type','interestable_id', DB::raw('count(*) as total'))->groupBy('interestable_type','interestable_id','interest->others');
            }else{
                $interests[$key]=$value->select('interestable_type','interestable_id', DB::raw('count(*) as total'))->groupBy('interestable_type','interestable_id');
            }
            $interests[$key]=$value->where('created_at','>',now()->subDays(7))->with('interestable')->orderByDesc('total')->get();
        }

        return view('livewire.analytics',['counts'=>$counts,'interests'=>$interests]);
    }
}
