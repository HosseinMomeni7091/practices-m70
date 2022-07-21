<?php

namespace App\Http\Controllers\API;

use App\Models\Order;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Resources\CommentResource;
use App\Http\Controllers\API\Controller;

class ApiCommentController extends Controller
{
    public function show (Request $request){
        $comments=Comment::with(["order"=>fn($order)=>$order->with("foods"),"user"])->whereRelation("order","restaurant_id",$request->restaurant_id)->get();
        // return CommentResource::collection($comments);
        return [
        //   "data"=>$comments,  
          "data"=>"okey",  
        ];
    }

    public function store (Request $request){

        if ((auth()->user()->id)==(Order::find($request->cart_id)->get()->first()->user_id)){
            Comment::create([
                "order_id" =>$request->cart_id,
                "user_id" =>auth()->user()->id,
                "score" =>$request->score,
            ]);
        }else{
            return abort(403);
        }
    }
}
