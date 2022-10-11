<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discount;
use App\Http\Requests\StoreDiscountRequest;
use App\Http\Requests\UpdateDiscountRequest;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->authorizeResource(Discount::class);
    }
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
     * @param  \App\Http\Requests\StoreDiscountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newcategory = Discount::create([
            "name" => $request->get("name"),
            "discount" => $request->get("off"),
        ]);
        $discounts = Discount::all();
        return view("admin.discount", compact("discounts"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function show(Discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function edit(Discount $discount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDiscountRequest  $request
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discount $discount)
    {
        // if we want to map manually(controller's methods to modelpolicy's methods)
        // $this->authorize('update', $discount);

        if($request->get("editevalue1")){
            $res=Discount::find($request->get("editeid"))->update([
                'name' => $request->get("editevalue1"),
            ]);
        }
        if($request->get("editevalue2")){
            $res=Discount::find($request->get("editeid"))->update([
                'discount' => $request->get("editevalue2"),
            ]);
        }
        $discounts = Discount::all();
        return view("admin.discount", compact("discounts"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Discount $discount)
    {
        $res=Discount::find($request->get("remove"))->delete();
        $discounts = Discount::all();
        return view("admin.discount", compact("discounts"));
    }
}
