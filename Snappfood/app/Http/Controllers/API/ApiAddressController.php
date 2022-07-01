<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Controller;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class ApiAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
       $addresses=UserAddress::where("user_id",auth()->user()->id)->get();
        return response()->json([
            "msg"=>"All Addresse of current user",
            "data"=>$addresses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $fields = $request->validate([
        //     'title' => 'required|string',
        //     'address' => 'required',
        //     'email' => 'required|string|unique:users,email',
        //     'password' => 'required|string',
        //     'role' => 'required',
        // ]); 
        $request->validate([
            'title' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);
        $newaddress=UserAddress::create([
            'title' => $request->title,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            "user_id"=>auth()->user()->id
        ]);

        return response()->json([
            "msg"=>"address added successfully",
            "detail"=>$newaddress

        ]);
    }

    /**
     * set address as current address of user.
     *
     * @param  int  $address_id
     * @return \Illuminate\Http\Response
     */
    public function currentAddress($address_id)
    {
        $setallzero=UserAddress::where("user_id",auth()->user()->id)->update(["is_current"=>0]);
        $addresses=UserAddress::where("id",$address_id)->update(["is_current"=>1]);

        return response()->json([
            "msg"=>"Current address set as default successfully.",
            "detail"=>$addresses

        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
