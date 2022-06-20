<?php

namespace App\Http\Controllers;

use App\Models\ServiceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagerController extends Controller
{
    public function reservationlist()
    {
        $users = DB::table('reservations')
            ->select('reservations.*')
            ->get()
            ->toArray();
        // dd($users);
        $services = [
            0 => "Internal",
            1 => "External",
            2 => "Basic",
        ];
        $days = [
            0 => "Saturday",
            1 => "Sunday",
            2 => "Monday",
            3 => "Tuesday",
            4 => "Wednesday",
            5 => "Thursday",
            6 => "Friday"
        ];
        return view('tabelereservation', compact("users", "services", "days"));
    }


    public function servicefilter(Request $request)
    {
        $services = [
            0 => "Internal",
            1 => "External",
            2 => "Basic",
        ];
        $days = [
            0 => "Saturday",
            1 => "Sunday",
            2 => "Monday",
            3 => "Tuesday",
            4 => "Wednesday",
            5 => "Thursday",
            6 => "Friday"
        ];

        if ($request->only("service")["service"] == "all") {
            $users = DB::table('reservations')
                ->select('reservations.*')
                ->get()
                ->toArray();
            return view('tabelereservation', compact("users", "services", "days"));
        } else {
            $users = DB::table('reservations')
                ->select('reservations.*')
                ->where("service", $request->only("service")["service"])
                ->get()
                ->toArray();
            return view('tabelereservation', compact("users", "services", "days"));
        }
    }

    public function dayfilter(Request $request)
    {
        $services = [
            0 => "Internal",
            1 => "External",
            2 => "Basic",
        ];
        $days = [
            0 => "Saturday",
            1 => "Sunday",
            2 => "Monday",
            3 => "Tuesday",
            4 => "Wednesday",
            5 => "Thursday",
            6 => "Friday"
        ];

        if ($request->only("day")["day"] == "all") {
            $users = DB::table('reservations')
                ->select('reservations.*')
                ->get()
                ->toArray();
            return view('tabelereservation', compact("users", "services", "days"));
        } else {
            $users = DB::table('reservations')
                ->select('reservations.*')
                ->where("day", $request->only("day")["day"])
                ->get()
                ->toArray();
            return view('tabelereservation', compact("users", "services", "days"));
        }
    }

    public function userlist()
    {

        // totaluser
        $totaluser = DB::table('users')
            ->select('users.*')
            ->get()
            ->toArray();
        // dd($totaluser);

        // totalID
        $totalID = DB::table('users')
            ->select('users.id')
            ->get()
            ->toArray();
        // dd($totalID);

        $totalcost = [];
        $reservationtable = DB::table('reservations')
            ->select('reservations.*')
            ->get()
            ->toArray();

        // dd($reservationtable);


        //accumolative cost 
        // ............................................................................
        foreach ($reservationtable as $key => $value) {
            $totalcost[$value->user_id] = $value->cost + ($totalcost[$value->user_id] ?? 0);
        }
        // dd($totalcost);


        //lastactivity
        // ............................................................................
        $totaluseraddedseen = $totaluser;
        foreach ($totaluseraddedseen as $key => $value) {
            $data = (array)$value;
            $users = DB::table('reservations')
                ->select('reservations.created_at')
                ->where("user_id", $data["id"])
                ->orderBy('created_at', 'desc')
                ->get()
                ->toArray();
            // dd($users[0]->created_at);
            $data["lastactivity"] = $users[0]->created_at ?? "No activity history";
            $totaluseraddedseen[$key] = $data;
        }
        // dd($totaluseraddedseen);




        //activity status
        // ............................................................................
        $activitystatus = $totaluser;
        foreach ($activitystatus as $key => $value) {
            $data = (array)$value;
            $users = DB::table('reservations')
                ->select('reservations.id')
                ->where("user_id", $data["id"])
                ->get()
                ->toArray();
            // dd($users);
            $count = count($users);
            if ($count == 0) {
                $data["activitystatus"] = "red";
            } elseif ($count < 2) {
                $data["activitystatus"] = "orange";
            } elseif ($count >= 2) {
                $data["activitystatus"] = "green";
            }
            $activitystatus[$key] = $data;
        }
        // dd($activitystatus);





        // merge data +cost 
        $totalusercomplete = $totaluser;
        foreach ($totalusercomplete as $key => $value) {
            $data = (array)$value;
            $data["totalcost"] = $totalcost[$data["id"]] ?? 0;
            $totalusercomplete[$key] = $data;
        }

        $totalinfo = $totaluser;
        foreach ($totalinfo as $key => $value) {
            $data = (array)$value;
            $data["totalcost"] = $totalusercomplete[$key]["totalcost"];
            $data["activitystatus"] = $activitystatus[$key]["activitystatus"];
            $data["lastactivity"] = $totaluseraddedseen[$key]["lastactivity"];
            $totalinfo[$key] = $data;
        }



        // dd($totalinfo,$totaluseraddedseen,$activitystatus,$totalusercomplete);

        return view('totalusersinfo', compact("totalinfo"));
    }

    public function reservedetail(Request $request)
    {
        // dd($request->only("id"));
        $users = DB::table('reservations')
            ->select('reservations.*')
            ->where("user_id", $request->only("id"))
            ->get()
            ->toArray();

        // dd($users);
        return view('reservedetails', compact("users"));
    }

    public function servicelist()
    {
        $services = DB::table('service_types')
            ->select('service_types.*')
            ->get()
            ->toArray();

        return view('servicesinfo', compact("services"));
    }

    public function editeservice(Request $request)
    {
        // dd($request->all(), $request->only("name")["name"]);
        if ($request->only("name")["name"] != null) {
            DB::table('service_types')
                ->where('id', $request->only("id")["id"])
                ->update(['name' => $request->only("name")["name"]]);
        }
        if ($request->only("time")["time"] != null) {
            DB::table('service_types')
                ->where('id', $request->only("id")["id"])
                ->update(['time' => $request->only("time")["time"]]);
        }
        if ($request->only("cost")["cost"] != null) {
            DB::table('service_types')
                ->where('id', $request->only("id")["id"])
                ->update(['cost' => $request->only("cost")["cost"]]);
        }

        $services = DB::table('service_types')
            ->select('service_types.*')
            ->get()
            ->toArray();

        return view('servicesinfo', compact("services"));
    }

    public function removeservice(Request $request)
    {

        // dd($request->all());

        if ($request->only("id")["id"] != null) {
            DB::table('service_types')
                ->where('id', $request->only("id")["id"])
                ->delete();
        }

        $services = DB::table('service_types')
            ->select('service_types.*')
            ->get()
            ->toArray();

        return view('servicesinfo', compact("services"));
    }

    public function createservice(Request $request)
    {
        ServiceType::create($request->only("name","time","cost"));

        $services = DB::table('service_types')
            ->select('service_types.*')
            ->get()
            ->toArray();

        return view('servicesinfo', compact("services"));
    }
}
