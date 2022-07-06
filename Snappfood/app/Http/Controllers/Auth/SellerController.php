<?php

namespace App\Http\Controllers\Auth;

use App\Models\Food;
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
    public function foods()
    {
        // $foodinfo=Food::whereBelongsTo(auth()->user()->restaurant)->get()->toArray();
        $foodinfos=Food::whereBelongsTo(auth()->user()->restaurant)->get();
        // dd(auth()->user()->restaurant->id,auth()->user()->id,$restinfo);
        // $url = Storage::url('images/food.jpg');
        // dd($url);
        // return view("seller.fooddashboard", compact($foodinfo));
        return view("seller.fooddashboard", compact("foodinfos"));
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
