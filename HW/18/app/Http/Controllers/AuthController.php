<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
  public function loginform()
  {
    return view("Auth.login");
  }
  public function registerform()
  {
    return view("Auth.register");
  }

  public function register(Request $request)
  {
    $user = $request->only("name", "family", "email", "phone", "password");
    $res = User::create($user);
    $userinfo =  User::where('email', $request->get('email'))->first();
    // Auth()->login($userinfo);
    session(["name" => $request->only("name")]);
    session(["family" => $request->only("family")]);
    session(["phone" => $request->only("phone")]);
    session(["email" => $request->only("email")]);
    session(["password" => $request->only("password")]);
    // dd(session("name"),session("phone"),$user,$res);
    redirect()->route("userDashboard");
    dd($user, $res);
  }


  public function login(Request $request)
  {
    // dd($request->only("email","password"));
    $result = auth()->attempt($request->only("email", "password"));
    // dd(auth()->user()->password);


    // dd(auth()->user()->is_ad)
    if ($result) {
      // set sessions
      session(["name" => auth()->user()->name]);
      session(["family" => auth()->user()->family]);
      session(["phone" => auth()->user()->phone]);
      session(["email" => auth()->user()->email]);
      session(["password" => auth()->user()->password]);

      //is_admin?
      $a = (DB::table('users')
        ->select("is_admin")
        ->where('email', $request->only("email"))
        ->get()
        ->toArray());

      if ($a) {
        $adminstatus = ($a)[0]->is_admin;
      if ($adminstatus) {
        return view('managerdashboard');
      }
      }

      // total reservation
      $turns = (DB::table('reservations')
        ->select("reservations.*")
        ->where('user_id', auth()->user()->id)
        ->get()
        ->toArray());

        // dd($turns);
        return view('userdashboard',compact("turns"));
    }
    return  redirect()->route("loginform")->with("loginerror", "Be Carefull sir, your inputed info are wrong");
  }
  public function Logout(Request $request)
  {
    $request->session()->forget(['name', "family", "email", "password", 'phone', 'day', 'service', 'track', 'time', 'code', "edite", "pretime"]);
    auth()->logout();
    return redirect()->route("loginform");
  }

  public function profilepage(Request $request) 
  {
    $a = (DB::table('users')
    ->select("users.*")
    ->where('email',session("email"))
    ->get()
    ->toArray());

    $name = ($a)[0]->name;
    $family = ($a)[0]->family;
    $email = ($a)[0]->email;
    $phone = ($a)[0]->phone;

    return view("profilepage",compact("name","family","email","phone"));
  }
  public function profilesave(Request $request) 
  {

    $a = (DB::table('users')
    ->select("users.id")
    ->where('email',session("email"))
    ->get()
    ->toArray());

    // if(!$request->only("name")["name"]){
    //   echo "salam";
    //   dd($request->only("name"),$a,session("email"),($a)[0]->id);
    // }
    // dd($request->only("family")["family"]);
     
    
    $user = User::find(($a)[0]->id);

    if($request->only("name")["name"]!=null){
      $user->update([
          "name" => $request->only("name")["name"],
      ]);
    }
    if($request->only("family")["family"]!=null){
      $user->update([
          "family" => $request->only("family")["family"],
      ]);
      // dd($user);
    }
    if($request->only("email")["email"]!=null){
      $user->update([
          "email" => $request->only("email")["email"],
      ]);
    }
    if($request->only("phone")["phone"]!=null){
      $user->update([
          "phone" => $request->only("phone")["phone"],
      ]);
    }

    $a = (DB::table('users')
    ->select("users.*")
    ->where('email',session("email"))
    ->get()
    ->toArray());

    $name = ($a)[0]->name;
    $family = ($a)[0]->family;
    $email = ($a)[0]->email;
    $phone = ($a)[0]->phone;

    return view("profilepage",compact("name","family","email","phone"));
  }
}
