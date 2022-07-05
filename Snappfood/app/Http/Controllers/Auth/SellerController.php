<?php

namespace App\Http\Controllers\Auth;

use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Http\Request;

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
    public function foods()
    {
        $restinfo=Food::where("restaurant_id",auth()->user()->restaurant_id)->get()->toArray();
        dd($restinfo);
    }
    public function sellerComments()
    {
        // return view('registerform')->with("message","Please fill the following form");
    }
    public function foodParty()
    {
        // return view('registerform')->with("message","Please fill the following form");
    }
    public function configuration()
    {
        $restinfo=Restaurant::find(auth()->user()->id)->toArray();
        dd($restinfo);
    }
}
