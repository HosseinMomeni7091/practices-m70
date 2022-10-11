<?php

namespace App\Http\Controllers\Auth;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;

class AuthController extends Controller
{
    public function login(StoreUserRequest $request)
    {
        if (Auth::attempt($request->only("email","password"))) {
            session(["name" => auth()->user()->name]);
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
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
        
    }

    public function register(Request $request)
    {
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
      
        if (auth()->user()->role == "admin"){
            return view('adminwelcome')->with("message","Welcome Dear Admin");
        }
        if (auth()->user()->role == "seller"){
            return view('sellerwelcome')->with("message","Welcome Dear Seller");
        }
        if (auth()->user()->role == "buyer"){
            return view('buyerwelcome')->with("message","Welcome Dear Buyr");
        }
    }


    public function logout(Request $request)
  {
      auth()->logout();
      $request->session()->invalidate();
      $request->session()->forget(['name']);
      $request->session()->regenerateToken();
      return redirect()->route("home");
  }
}
