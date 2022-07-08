<?php

namespace App\Http\Controllers;

use App\Models\FoodCategory;
use App\Models\RestCategory;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;


class FoodCategoryController extends Controller
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
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newcategory = FoodCategory::create([
            "name" => $request->get("name")
        ]);
        // $newcategory->save();
        $foodcategories = FoodCategory::all();
        return view("admin.foodcategory", compact("foodcategories"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(FoodCategory $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(FoodCategory $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FoodCategory $category)
    {
        $res=FoodCategory::find($request->get("editeid"))->update([
            'name' => $request->get("editevalue"),
        ]);
        $foodcategories = FoodCategory::all();
        return view("admin.foodcategory", compact("foodcategories"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,FoodCategory $category)
    {
        $res=FoodCategory::find($request->get("remove"))->delete();
        $foodcategories = FoodCategory::all();
        return view("admin.foodcategory", compact("foodcategories"));
    }
}
