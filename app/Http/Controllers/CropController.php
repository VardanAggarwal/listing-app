<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCropRequest;
use App\Http\Requests\UpdateCropRequest;
use App\Models\Crop;
use App\Models\Resiliency;


class CropController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('crops.index',['crops'=> Resiliency::whereHasMorph('resilient',[Crop::class])->with(['categories','resilient'])->orderByDesc('created_at')->get()]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crops.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCropRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCropRequest $request)
    {

        $crop=Crop::create($request->all());
        return redirect('/crops/'.$crop->id);
        //return view('crops.crop',['crop'=>$crop]);
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Crop  $crop
     * @return \Illuminate\Http\Response
     */
    public function show(Crop $crop)
    {
        return view('crops.crop',['crop'=>$crop->load(['resiliency'=>function($query){
            $query->with(['categories']);
        }])]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Crop  $crop
     * @return \Illuminate\Http\Response
     */
    public function edit(Crop $crop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCropRequest  $request
     * @param  \App\Models\Crop  $crop
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCropRequest $request, Crop $crop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Crop  $crop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Crop $crop)
    {
        //
    }
}
