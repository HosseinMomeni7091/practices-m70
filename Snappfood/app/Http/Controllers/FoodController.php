<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;
use App\Models\FoodCategory;
use App\Http\Requests\StoreFoodRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateFoodRequest;

class FoodController extends Controller
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
    public function create(Request $request)
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFoodRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $food=Food::create([
            "name"=>$request->only("name")["name"],
            "raw"=>$request->only("raw")["raw"],
            "price"=>$request->only("price")["price"],
            "discount"=>$request->only("discount")["discount"],
            "restaurant_id"=>auth()->user()->restaurant->id,
            "food_category_id"=>$request->only("food_category_id")["food_category_id"],
        ]);
        if($request->file('image')!=null){
            $path = Storage::putFile('/public/images', $request->file('image'));
            $path=str_replace("public","storage",$path);
            $food->update([
                "image"=>$path
            ]);
        }
        if($request->only("is_foodparty")==null){
            $food->update([
                "is_foodparty"=>"0"
            ]);
        }else{
            $food->update([
                "is_foodparty"=>"1"
            ]);
        }
        return view("seller.adddone");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function show(Food $food)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function edit(Food $food)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFoodRequest  $request
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Food $food)
    {

        if($request->file('image')!=null){
            $path = Storage::putFile('/public/images', $request->file('image'));
            $path=str_replace("public","storage",$path);
            $food->update([
                "image"=>$path
            ]);
        }
        $food->update([
            "name"=>$request->only("name")["name"],
            "raw"=>$request->only("raw")["raw"],
            "price"=>$request->only("price")["price"],
            "discount"=>$request->only("discount")["discount"],
        ]);
        if($request->only("is_foodparty")==null){
            $food->update([
                "is_foodparty"=>"0"
            ]);
        }else{
            $food->update([
                "is_foodparty"=>"1"
            ]);
        }
        return view("seller.editedone");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function destroy(Food $food)
    {
        Food::find($food->id)->delete();
        $categories = FoodCategory::select(["name", "id"])->get();
        $foodinfos = Food::whereBelongsTo(auth()->user()->restaurant)->get();
        return view("seller.fooddashboard", compact("foodinfos", "categories"));

    }
}
