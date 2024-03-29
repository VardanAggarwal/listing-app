<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
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
        $profile=$user=Auth::user()->profile;
        if(!$profile){
            $profile=new Profile;
            $profile->name=Auth::user()->name;
        }else{
            $profile->contact_number=str_replace("+91","",$profile->contact_number);
        }
        return view('profiles.new',['profile'=>$profile]);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProfileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfileRequest $request)
    {
        $raw=$request->all();
        $profile_id=$raw['id'];
        $validated = $request->validate([
            'name' => 'string|required',
            'address' => 'string|nullable',
            'pincode'=>'numeric|nullable|digits:6',
            'contact_number'=>'numeric|required|digits:10'
        ]);
        $user=Auth::user();

        $profile=$user->profile()->findOrNew($profile_id);
        $validated["contact_number"]="+91".$validated["contact_number"];
        $profile->fill($validated)->save();
        if($profile->additional_info){
            if($profile->additional_info['onboarding']){
                return redirect('/');                
            }
        }
        return redirect('/onboarding');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        $profile->loadCount(['listings','stories','interest_resiliencies','expert_resiliencies']);
        return view('profiles.profile',['profile'=>$profile]);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProfileRequest  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
    public function interests()
    {
        return view('profiles.interests',['profile'=>Auth::user()->profile->load('interest_resiliencies')]);
    }
    public function verify(Request $request, Profile $profile){
        if(Auth::user()->role_id==1){
            $profile->status=$request->role;
            $profile->save();
        }
        return redirect('/profiles/'.$profile->id);
    }
}
