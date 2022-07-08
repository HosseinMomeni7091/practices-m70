<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\RestCategory;
use Illuminate\Http\Request;


class RestCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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

        $newcategory = RestCategory::create([
            "name" => $request->get("name")
        ]);
        // $newcategory->save();
        $restcategories = RestCategory::all();
        return view("admin.restcategory", compact("restcategories"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(RestCategory $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(RestCategory $category)
    {

        $restcategories = RestCategory::all();
        return view("admin.restcategory", compact("restcategories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RestCategory $category)
    {
        $res=RestCategory::find($request->get("editeid"))->update([
            'name' => $request->get("editevalue"),
        ]);
        $restcategories = RestCategory::all();
        return view("admin.restcategory", compact("restcategories"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, RestCategory $category)
    {
        $res=RestCategory::find($request->get("remove"))->delete();
        $restcategories = RestCategory::all();
        return view("admin.restcategory", compact("restcategories"));
    }
}
