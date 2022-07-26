<?php

namespace App\Http\Controllers\API;

use App\Models\Order;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Resources\CommentResource;
use App\Http\Controllers\API\Controller;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ApiCommentController extends Controller
{
    public function show(Request $request)
    {
        if (isset($request->restaurant_id)) {
            $comments = Comment::with(["order" => fn ($order) => $order->with("foods"), "user"])->whereRelation("order", "restaurant_id", $request->restaurant_id)->where("status", "approved")->get();
            return CommentResource::collection($comments);
        }
        if (isset($request->food_id)) {

            $comments=[];
            $final=[];
            $orders=Order::whereHas('foods', function (Builder $query) use($request){
                $query->where('food_id', $request->food_id);
            })->get();

            if (count($orders)){
                foreach($orders as $order){
                    $comments= Comment::with(["order" => fn ($order) => $order->with("foods"), "user"])->where("order_id",$order->id)->where("status", "approved")->get();
                    $final[]=CommentResource::collection($comments);
                }
                return $final;
            }
            return ["data"=>"There are no comment for this food"];
        }
    }

    public function store(Request $request)
    {
        if ((auth()->user()->id) == (Order::where("id",$request->cart_id)->get()->first()->user_id)) {
            if ((Order::where("id",$request->cart_id)->get()->first()->status) == "Delivered") {
                if ((Comment::where("order_id",$request->cart_id)->where("user_id",auth()->user()->id)->get()->isNotEmpty())){
                    return ["massage" => "You already sent your reply"];
                }else{
                    $Comment = Comment::create([
                        "order_id" => $request->cart_id,
                        "user_id" => auth()->user()->id,
                        "score" => $request->score,
                        "comment" => $request->massage,
                    ]);
                    return ["data" => $Comment];
                }
            } else {
                return ["massage" => "Your order don't be delivered, Dada!! First Taste it then send your steemed feedback"];
            }
        } else {
           return abort(403);
        }
    }
}
