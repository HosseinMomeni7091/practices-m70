<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\RestAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;

class RestaurantController extends Controller
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
     * @param  \App\Http\Requests\StoreRestaurantRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $restaurant=Restaurant::create([
            "user_id"=>auth()->user()->id,
            "name"=>$request->only("name")["name"],
            "phone"=>$request->only("phone")["phone"],
            "freight"=>$request->only("freight")["freight"],
            "rest_category_id"=>$request->only("category")["category"],
            "bank_account"=>$request->only("bank_account")["bank_account"],
        ]);
        if($request->only("address")!=[]){

            $restaddress=RestAddress::create([
                "address"=>$request->only("address")["address"],
                "latitude"=>$request->only("latitude")["latitude"],
                "longitude"=>$request->only("longitude")["longitude"],

            ]);

            $restaurant->update([
                "rest_address_id"=>$restaddress->id
            ]);
        }
         if($request->file('image')!=null){
            $path = Storage::putFile('/public/images', $request->file('image'));
            $path=str_replace("public","storage",$path);
            $restaurant->update([
                "picture"=>$path
            ]);
        }
        
        return view("seller.restaurantCreated");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRestaurantRequest  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        if($request->file('image')!=null){
            $path = Storage::putFile('/public/images', $request->file('image'));
            $path=str_replace("public","storage",$path);
            $restaurant->update([
                "picture"=>$path
            ]);
        }
        $restaurant->update([
            "name"=>$request->only("name")["name"],
            "phone"=>$request->only("phone")["phone"],
            "freight"=>$request->only("freight")["freight"],
            "bank_account"=>$request->only("bank_account")["bank_account"],
            "rest_category_id"=>$request->only("category")["category"],
        ]);
        if($request->only("address")!=[]){
            $restaurant->restaddress()->update([
                "address"=>$request->only("address")["address"],
                "latitude"=>$request->only("latitude")["latitude"],
                "longitude"=>$request->only("longitude")["longitude"],
            ]);
        }
        
        return view("seller.editedone");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        //
    }
}
