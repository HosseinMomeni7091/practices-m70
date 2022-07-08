<?php

namespace App\Http\Controllers\API;

use App\Models\Food;
use App\Models\Restaurant;
use App\Models\RestCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\API\Controller;
use App\Http\Resources\RestaurantResource;

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
        $res = Restaurant::with("restaddress")->where("id", $restaurant_id)->get();
        return RestaurantResource::collection($res);
        // return response()->json([
        //     "requested id" => $restaurant_id,
        //     "data" => $res
        // ]);
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
    public function show(Request $request)
    {

        $condition = [];
        if ($request->rest_category_name != null) {
            $condition["name"] = $request->rest_category_name;
        }
        if ($request->is_active != null) {
            $condition["is_active"] = $request->is_active;
        }
        if ($request->score != null) {
            $condition["score"] = $request->score;

        }
        $categoryMape=RestCategory::all()->toArray();
        foreach ($categoryMape as $key=>$value){
            $map[$value["name"]]=$value["id"];
        }
        $restaurant = Restaurant::with("restcategory", "restaddress", "schedule");
        if (count($condition) == 0) {
            $result = $restaurant->get();
            return response()->json([
                "requested id" => "all",
                "data" => $result
            ]);
        }

        foreach ($condition as $key => $value) {
            if ($key=="name"){
                $restaurant->where("rest_category_id", $map[$value]);
            }else{
                $restaurant->where($key, $value);
            }
        }

        $result = $restaurant->get();

        return RestaurantResource::collection($result);

        // return response()->json([
        //     "requested id" => $condition,
        //     "data" => $result
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
        $foods = Food::where("restaurant_id", $restaurant_id)->get();
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
