<?php

namespace App\Http\Controllers\Auth;

use App\Models\Food;
use App\Models\FoodCategory;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SellerController extends Controller
{
    public function currentOrders()
    {
        // return view('loginform')->with("message","Please fill the following form");
    }
    public function completedOrders()
    {
        // return view('registerform')->with("message","Please fill the following form");
    }
    public function sellReport()
    {
        // return view('registerform')->with("message","Please fill the following form");
    }
    public function foods(Request $request)
    {
        $categories = FoodCategory::select(["name", "id"])->get();
        if ($request->only("namesearch") != []) {
            $foodinfos = Food::whereBelongsTo(auth()->user()->restaurant)->where("name", $request->only("namesearch")["namesearch"])->get();
            return view("seller.fooddashboard", compact("foodinfos", "categories"));
        }
        if ($request->only("categoryfilter") != []) {

            if ($request->only("categoryfilter")["categoryfilter"] == "all") {
                $foodinfos = Food::whereBelongsTo(auth()->user()->restaurant)->get();
                return view("seller.fooddashboard", compact("foodinfos", "categories"));
            } else {
                $foodinfos = Food::whereBelongsTo(auth()->user()->restaurant)->where("food_category_id", $request->only("categoryfilter")["categoryfilter"])
                    ->get();
                return view("seller.fooddashboard", compact("foodinfos", "categories"));
            }
        }
        $foodinfos = Food::whereBelongsTo(auth()->user()->restaurant)->get();
        return view("seller.fooddashboard", compact("foodinfos", "categories"));
    }
    public function sellerComments()
    {
        // return view('registerform')->with("message","Please fill the following form");
    }
    public function foodParty()
    {
        // return view('registerform')->with("message","Please fill the following form");
    }
    public function updateconfiguration()
    {
        $restinfo = Restaurant::where("user_id", auth()->user()->id)->get()->first();
        // dd($restinfo->name);
        return view("seller.updatesellerconfig", compact("restinfo"));
    }
    public function configuration()
    {

        $result = Restaurant::where("user_id", auth()->user()->id)->get()->first();
        if ($result == null) {
            $status = false;
        } else {
            $status = true;
        }
        return view("seller.sellerconfig", compact("status"));
    }
    public function editefood(Request $request)
    {
        $food = Food::find($request->only("editefood")["editefood"]);
        // dd($request->only("editefood")["editefood"],$food);
        return view("seller.foodedite", compact("food"));
    }
    public function createfood()
    {
        $categories = FoodCategory::select(["name", "id"])->get();
        return view("seller.addfood", compact("categories"));
    }
}
