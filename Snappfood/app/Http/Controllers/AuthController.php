<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        auth()->attempt($request->only("email","password"));
        session(["name" => auth()->user()->name]);
        
        if (auth()->user()->role == "admin"){
            return view('admin')->with("message","Welcome Dear Admin");
        }
        if (auth()->user()->role == "seller"){
            return view('seller')->with("message","Welcome Dear Admin");
        }
        if (auth()->user()->role == "user"){
            return view('user')->with("message","Welcome Dear Admin");
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
        if (auth()->user()->role == "user"){
            return view('user')->with("message","Welcome Dear Admin");
        }
    }


    public function Logout(Request $request)
  {
    $request->session()->forget(['name']);
    auth()->logout();
    return redirect()->route("Welcome");
  }
}
