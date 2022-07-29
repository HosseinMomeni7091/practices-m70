<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
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
        $schedule=Schedule::create([
            "sat_start"=>$request->only("sat_start")["sat_start"] ?? "00:00",
            "sun_start"=>$request->only("sun_start")["sun_start"] ?? "00:00",
            "mon_start"=>$request->only("mon_start")["mon_start"] ?? "00:00",
            "tues_start"=>$request->only("tues_start")["tues_start"] ?? "00:00",
            "wednes_start"=>$request->only("wednes_start")["wednes_start"] ?? "00:00",
            "thurs_start"=>$request->only("thurs_start")["thurs_start"] ?? "00:00",
            "fri_start"=>$request->only("fri_start")["fri_start"] ?? "00:00",
            "sat_end"=>$request->only("sat_end")["sat_end"] ?? "00:00",
            "sun_end"=>$request->only("sun_end")["sun_end"] ?? "00:00",
            "mon_end"=>$request->only("mon_end")["mon_end"] ?? "00:00",
            "tues_end"=>$request->only("tues_end")["tues_end"] ?? "00:00",
            "wednes_end"=>$request->only("wednes_end")["wednes_end"] ?? "00:00",
            "thurs_end"=>$request->only("thurs_end")["thurs_end"] ?? "00:00",
            "fri_end"=>$request->only("fri_end")["fri_end"] ?? "00:00",
        ]);

        $restaurant=Restaurant::create([
            "user_id"=>auth()->user()->id,
            "name"=>$request->only("name")["name"],
            "phone"=>$request->only("phone")["phone"],
            "freight"=>$request->only("freight")["freight"],
            "rest_category_id"=>$request->only("category")["category"],
            "bank_account"=>$request->only("bank_account")["bank_account"],
            "schedule_id"=>$schedule->id,
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
        $restaurant->schedule()->update([
            "sat_start"=>$request->only("sat_start")["sat_start"] ?? "00:00",
            "sun_start"=>$request->only("sun_start")["sun_start"] ?? "00:00",
            "mon_start"=>$request->only("mon_start")["mon_start"] ?? "00:00",
            "tues_start"=>$request->only("tues_start")["tues_start"] ?? "00:00",
            "wednes_start"=>$request->only("wednes_start")["wednes_start"] ?? "00:00",
            "thurs_start"=>$request->only("thurs_start")["thurs_start"] ?? "00:00",
            "fri_start"=>$request->only("fri_start")["fri_start"] ?? "00:00",
            "sat_end"=>$request->only("sat_end")["sat_end"] ?? "00:00",
            "sun_end"=>$request->only("sun_end")["sun_end"] ?? "00:00",
            "mon_end"=>$request->only("mon_end")["mon_end"] ?? "00:00",
            "tues_end"=>$request->only("tues_end")["tues_end"] ?? "00:00",
            "wednes_end"=>$request->only("wednes_end")["wednes_end"] ?? "00:00",
            "thurs_end"=>$request->only("thurs_end")["thurs_end"] ?? "00:00",
            "fri_end"=>$request->only("fri_end")["fri_end"] ?? "00:00",
        ]);
        
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
