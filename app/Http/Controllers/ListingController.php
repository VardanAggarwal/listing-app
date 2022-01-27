<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function show(Listing $listing)
    {
        $listing->load(['profile']);
        $listing->loadCount(['resiliencies']);
        $listing->profile->loadCount('stories');
        return view('listing',['listing'=>$listing]);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function edit(Listing $listing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Listing $listing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Listing $listing)
    {
        if(Auth::user()){
            if(Auth::user()->role_id==1 || Auth::user()->profile->id==$listing->profile_id){
                Models\Feed::where('feedable_type','App\\Models\\Listing')->where('feedable_id',$listing->id)->delete();
                $listing->resiliencies()->sync([]);
                $listing->interested_profiles()->sync([]);
                Models\Attachable::where('attachable_type','App\\Models\\Listing')->where('attachable_id',$listing->id)->delete();
                foreach($listing->statements as $statement){
                    $statement->stateable()->dissociate();
                }
                $listing->delete();
                return redirect('/listings');
            }
        }
        return redirect('/listings/'.$listing->id);
    }
}
