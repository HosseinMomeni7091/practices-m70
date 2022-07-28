<?php

namespace App\Http\Controllers\API;

use App\Models\Food;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\API\Controller;
use App\Http\Resources\OrderResource;



class ApiOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res = Order::with("restaurant", "foods")->get();
        return OrderResource::collection($res);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($cart_id)
    {
        $res = Order::with("restaurant", "foods")->where("id",$cart_id)->get();
        return OrderResource::collection($res);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    /**
     * Show the form for addtocart the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addtocart(Request $request)
    {
        $request->validate([
            'food_id' => 'required',
            'count' => 'required',
        ]);


        $restId = Food::find($request->get("food_id"))->restaurant->id;
        $foodPrice = Food::find($request->get("food_id"))->get()->first()->price;
        $foodDiscount = Food::find($request->get("food_id"))->get()->first()->discount;
        $cartInfo = Order::where([["restaurant_id", $restId], ["user_id", auth()->user()->id], ["status", "ordering"]]);

        if ($cartInfo->get()->isEmpty()) {
            $result = Order::create([
                'user_id' => auth()->user()->id,
                'restaurant_id' => $restId,
                'quantity' => $request->get("count"),
                'cost' => ($foodPrice) * ($request->get("count"))*(100-$foodDiscount)/100,
            ]);
            $cartID = $result->id;
            $result->foods()->attach($request->get("food_id"), ["count" => $request->get("count")]);
        } else {
            $currentCart = $cartInfo->get()->first();
            $cartID = $currentCart->id;

            // add to pivot table food_order
            $currentCart->foods()->attach($request->get("food_id"), ["count" => $request->get("count")]);

            // Update current cart
            $currentCart->update([
                'quantity' => ($currentCart->quantity) + ($request->get("count")),
                'cost' => ($currentCart->cost) + (($foodPrice) * ($request->get("count"))*((100-$foodDiscount)/100)),
            ]);
        }

        return response()->json([
            "massage" => "food added to cart successfully",
            "cart_id" => $cartID,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'food_id' => 'required',
            'count' => 'required',
        ]);


        $restId = Food::find($request->get("food_id"))->restaurant->id;
        $foodPrice = Food::find($request->get("food_id"))->get()->first()->price;
        $foodDiscount = Food::find($request->get("food_id"))->get()->first()->discount;
        $cartInfo = Order::where([["restaurant_id", $restId], ["user_id", auth()->user()->id], ["status", "ordering"]]);

        if ($cartInfo->get()->isEmpty()) {
            $result = Order::create([
                'user_id' => auth()->user()->id,
                'restaurant_id' => $restId,
                'quantity' => $request->get("count"),
                'cost' => $foodPrice,
            ]);
            $cartID = $result->id;
            $result->foods()->attach($request->get("food_id"), ["count" => $request->get("count")]);
        } else {
            $currentCart = $cartInfo->get()->first();
            $cartID = $currentCart->id;

            $previousValue = DB::table("food_order")->where([["order_id", $currentCart->id], ["food_id", $request->get("food_id")]])->get()->first()->count;

            if ($request->get("count") != 0) {

                // Update pivot table food_order
                $currentCart->foods()->updateExistingPivot($request->get("food_id"), ["count" => $request->get("count")]);

                // Update current cart
                $currentCart->update([
                    'quantity' => ($currentCart->quantity) - (($previousValue) - ($request->get("count"))),
                    'cost' => ($currentCart->cost) - ($foodPrice) * (($previousValue) - ($request->get("count"))),
                ]);
            } else {
                // Update pivot table food_order
                $currentCart->foods()->detach($request->get("food_id"));

                // Update current cart
                if (($currentCart->quantity) - (($previousValue) - ($request->get("count"))) == 0) {
                    $currentCart->delete();
                } else {
                    $currentCart->update([
                        'quantity' => ($currentCart->quantity) - (($previousValue) - ($request->get("count"))),
                        'cost' => ($currentCart->cost) - ($foodPrice) * (($previousValue) - ($request->get("count"))),
                    ]);
                }
            }
        }

        return response()->json([
            "massage" => "cart updated successfully",
            "Cart id" => $restId,
        ]);
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



    /**
     * pay the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pay($cart_id)
    {
        
        $currentCart = Order::where("id",$cart_id)->get()->first();
        $currentCart->update([
            'status' => "paid",
        ]);
        $currentCart->save();
        // return OrderResource::collection($currentCart);
        return [
            "massage" => "Status of order improved to Paid.",
            "data" => $currentCart,
        ];
    }
}
