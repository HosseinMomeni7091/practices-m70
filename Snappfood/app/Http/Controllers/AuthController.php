<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // dd($request->only("email","password"));
        auth()->attempt($request->only("email","password"));
        session(["name" => auth()->user()->name]);

        // dd(auth()->user());
        
        if (auth()->user()->role == "admin"){
            return view('adminwelcome')->with("message","Welcome Dear Admin");
        }
        if (auth()->user()->role == "seller"){
            return view('sellerwelcome')->with("message","Welcome Dear Seller");
        }
        if (auth()->user()->role == "buyer"){
            return view('userwelcome')->with("message","Welcome Dear Buyr");
        }
    }

    public function register(Request $request)
    {
        // dd($request->all());
        $res = User::create([
            "name" => $request->get('name'),
            "email" => $request->get('email'),
            "phone" => $request->get('phone'),
            "address" => $request->get('address'),
            "latitude" => $request->get('latitude'),
            "longitude" => $request->get('longitude'),
            "role" => $request->get('role'),
            "password" => Hash::make($request->get('password')),
          ]);
          
        auth()->attempt($request->only("email","password"));
        session(["name" => auth()->user()->name]);

        dd(auth()->user());

        if (auth()->user()->role == "admin"){
            return view('admin')->with("message","Welcome Dear Admin");
        }
        if (auth()->user()->role == "seller"){
            return view('seller')->with("message","Welcome Dear Admin");
        }
        if (auth()->user()->role == "buyer"){
            return view('user')->with("message","Welcome Dear Admin");
        }
    }


    public function logout(Request $request)
  {
    $request->session()->forget(['name']);
    auth()->logout();
    return redirect()->route("home");
  }
}
