<?php

namespace App\Http\Controllers;

use App\Models\Agriservice;
use Illuminate\Http\Request;

class AgriserviceController extends Controller
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
     * @param  \App\Models\Agriservice  $agriservice
     * @return \Illuminate\Http\Response
     */
    public function show(Agriservice $agriservice)
    {
        $agriservice->load(['profile']);
        $agriservice->loadCount(['resiliencies']);
        return view('agriservice',['agriservice'=>$agriservice]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agriservice  $agriservice
     * @return \Illuminate\Http\Response
     */
    public function edit(Agriservice $agriservice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agriservice  $agriservice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agriservice $agriservice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agriservice  $agriservice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agriservice $agriservice)
    {
        //
    }
}
