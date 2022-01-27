<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;

class StoryController extends Controller
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
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function show(Story $story)
    {
        $story->load(['profile']);
        $story->loadCount(['resiliencies']);
        $story->profile->loadCount('listings');
        return view('story',['story'=>$story]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function edit(Story $story)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Story $story)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function destroy(Story $story)
    {
        if(Auth::user()){
            if(Auth::user()->role_id==1 || Auth::user()->profile->id==$story->profile_id){
                Models\Feed::where('feedable_type','App\\Models\\Story')->where('feedable_id',$story->id)->delete();
                $story->resiliencies()->sync([]);
                $story->interested_profiles()->sync([]);
                Models\Attachable::where('attachable_type','App\\Models\\Story')->where('attachable_id',$story->id)->delete();
                foreach($story->statements as $statement){
                    $statement->stateable()->dissociate();
                }
                $story->delete();
                return redirect('/stories');
            }
        }
        return redirect('/stories/'.$story->id);
    }
}
