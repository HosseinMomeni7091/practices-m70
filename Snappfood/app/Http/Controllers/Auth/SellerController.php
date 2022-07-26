<?php

namespace App\Http\Controllers\Auth;

use App\Models\Food;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Restaurant;
use App\Models\FoodCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SellerController extends Controller
{
    public function currentOrders()
    {   
        $result = Order::with("restaurant","user","foods")->where("restaurant_id",auth()->user()->restaurant->id)->where("status","!=","Delivered")->get();
        return view("seller.currentorder",compact("result"));

    }
    public function detailCurrentOrders(Request $request)
    {   
        $result = Order::with("restaurant","user","foods")->where("id",$request->orderId)->get()->first();
        return view("seller.detailcurrentorder",compact("result"));

    }
    public function UpdateOrderStatus(Request $request)
    {   
        // Update order
        $update = Order::where("id",$request->orderId)->update(["status"=>$request->status]);
        // $update->save();

        // Get full info
        $result = Order::with("restaurant","user","foods")->where("restaurant_id",auth()->user()->restaurant->id)->where("status","!=","Delivered")->get();
        return view("seller.currentorder",compact("result"));

    }
    public function completedOrders()
    {
        $result = Order::with("restaurant","user","foods")->where("restaurant_id",auth()->user()->restaurant->id)->where("status","Delivered")->get();
        return view("seller.completeorder",compact("result"));
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
        $foodinfos = Food::whereBelongsTo(auth()->user()->restaurant)->get();
        $result=Order::with("foods")->whereBelongsTo(auth()->user()->restaurant)->has('comments')->get();
        return view("seller.comments",compact("result","foodinfos"));
    }
    public function searchCommentOfFood(Request $request)
    {
        $foodId=$request->foodidfilter;
        $foodinfos = Food::whereBelongsTo(auth()->user()->restaurant)->get();
        $result=Order::whereBelongsTo(auth()->user()->restaurant)->whereRelation("foods","food_id",$foodId)->has('comments')->get();
        if(($request->foodidfilter)=="all"){
            $result=Order::whereBelongsTo(auth()->user()->restaurant)->has('comments')->get();
        }
        return view("seller.comments",compact("result","foodinfos"));
    }
    public function comments(Request $request)
    {
        $comments=Comment::where('order_id',$request->orderId)->get();
        $orderId=$request->orderId;
        // dd($comments);
        return view("seller.detailcomments",compact("comments","orderId"));
    }
    public function updateCommentStatus(Request $request)
    {
        $update=Comment::where("id",$request->comment_id)->update([
            "status"=>$request->status
        ]);
        $orderId=$request->orderId;
        $comments=Comment::where('order_id',$request->orderId)->get();
        return view("seller.detailcomments",compact("comments","orderId"));
    }
    public function sendCommentReply(Request $request)
    {
        $update=Comment::where("id",$request->comment_id)->update([
            "reply"=>$request->reply
        ]);
        $orderId=$request->orderId;
        $comments=Comment::where('order_id',$request->orderId)->get();
        return view("seller.detailcomments",compact("comments","orderId"));
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
