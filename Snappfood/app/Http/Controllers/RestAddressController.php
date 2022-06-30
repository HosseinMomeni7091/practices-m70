<?php

namespace App\Http\Controllers;

use App\Models\RestAddress;
use App\Http\Requests\StoreRestAddressRequest;
use App\Http\Requests\UpdateRestAddressRequest;

class RestAddressController extends Controller
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
     * @param  \App\Http\Requests\StoreRestAddressRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRestAddressRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RestAddress  $restAddress
     * @return \Illuminate\Http\Response
     */
    public function show(RestAddress $restAddress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RestAddress  $restAddress
     * @return \Illuminate\Http\Response
     */
    public function edit(RestAddress $restAddress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRestAddressRequest  $request
     * @param  \App\Models\RestAddress  $restAddress
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRestAddressRequest $request, RestAddress $restAddress)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RestAddress  $restAddress
     * @return \Illuminate\Http\Response
     */
    public function destroy(RestAddress $restAddress)
    {
        //
    }
}
