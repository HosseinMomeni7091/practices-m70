<?php

namespace App\Http\Controllers\API;

use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\API\Controller;

class ApiRestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($restaurant_id)
    {
        // $res=Restaurant::find($restaurant_id)->restaddress;
        // return response()->json([
        //     "requested id"=> $restaurant_id,
        //     "data"=>$res
        // ]);
        // $res=Restaurant::where("id",$restaurant_id)->get();
        $res=Restaurant::with("restaddress")->where("id",$restaurant_id)->get();
        return response()->json([
            "requested id"=> $restaurant_id,
            "data"=>$res
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($restaurant_id)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($request)
    {
        $restaurant=Restaurant::query();
        return response()->json([
            "requested id"=> "all",
            "data"=>$restaurant
        ]);
        // $restaurant=Restaurant::all();
        // return response()->json([
        //     "requested id"=> "all",
        //     "data"=>$restaurant
        // ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showFood($restaurant_id)
    {
        $foods=Food::where("restaurant_id",$restaurant_id)->get();
        // $foods=Food::all();
        return response($foods);
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
