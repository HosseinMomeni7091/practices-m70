<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Timetable;
use App\Models\Reservation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class usercontroller extends Controller
{
    public function type(Request $request)
    {
        // dd($request->all());
        session(["name" => $request->all("name")["name"]]);
        session(["phone" => $request->all("phone")["phone"]]);
        session(["service" => $request->all("service")["service"]]);
        session(["timetype" => $request->all("timetype")["timetype"]]);
        // dd($request->session()->get("name"));

        if (($request->all("timetype"))["timetype"] == "Automatic") {
            return redirect()->route('AutomaticReservation');
        } elseif (($request->all("timetype"))["timetype"] == "Manually") {
            return redirect()->route('ManualReservation');
        }

        return ($request->all("timetype"))["timetype"];
    }

    public function automaticReserve(Request $request)
    {
        // prepare data from DB


        // prepare for sending data
        $Day = "Monday";
        $Time = "9-9:20";

        // pass data into related view

        return view('reservation21', compact("Day", "Time"));
    }

    public function manualReserve(Request $request)
    {
        // Timetable
        $all = Timetable::all()->toArray();
        $final = [];
        foreach ($all as $key => $value) {
            for ($i = 0; $i < 144; $i++) {
                if ($value[$i] == 2) {
                    $final[$key][$i] = "bg-red-600";
                } else {
                    $final[$key][$i] = "bg-green-600";
                }
            }
        }
        // pass into view

        return view('reservation22', compact("final"));
    }

    public function preProccess(Request $request)
    {
        session(["day" => $request->all("day")["day"]]);
        $day = $request->all("day")["day"];
        $service = $request->session()->get("service");


        // dd($day,$service);
        $map1 = [
            "Saturday" => "0",
            "Sunday" => "1",
            "Monday" => "2",
            "Tuesday" => "3",
            "Wednesday" => "4",
            "Thursday" => "5",
            "Friday" => "6"
        ];
        $map2 = [
            "Basic" => 12,
            "Internal" => 4,
            "External" => 3,
        ];

        $all = Timetable::all()->toArray();
        $final = [];
        $alltime = $all[$map1[$day]];
        unset($alltime['id']);
        unset($alltime['day']);
        // echo '<pre>';
        // print_r($alltime);
        // echo '</pre>'.'<br>';

        // dd((($alltime[141]??2) == 2));

        for ($i = 0; $i < 144; $i++) {
            $result = 1;
            // echo "i:" . $i . "</br>";
            for ($j = 0; $j < $map2[$service]; $j++) {
                if (($alltime[$i + $j] ?? 2) == 2) {
                    $result = $result * 0;
                }
                // echo "j:" . $j . "</br>";
            }
            // echo "result:" . $result . "</br>";
            // echo "<hr>";
            if ($result == 1) {
                // Cal start time
                $hr1 = floor($i / 12) + 9;
                // echo "strat:hr1:" . $hr1 . "</br>";

                $mn1 = (($i - floor($i / 12) * 12)) * 5;
                // echo "start:mn1:" . $mn1 . "</br>";

                $strt = $hr1 . ":" . $mn1;
                if ($mn1 == 60) {
                    $mn1 = 0;
                    $hr1 = ($hr1 + 1);
                }

                // Cal End time
                $hr2 = floor(($i + $map2[$service]) / 12) + 9;
                $mn2 = ((($i + $map2[$service]) - floor(($i + $map2[$service]) / 12) * 12)) * 5;
                $end = $hr2 . ":" . $mn2;

                if ($mn2 == 60) {
                    $mn2 = 0;
                    $hr2 = ($hr2 + 1);
                }
                $final[] = ["start" => [$hr1, $mn1], "end" => [$hr2, $mn2]];
                // echo "end:hr2:" . $hr2 . "</br>";
                // echo "end:mn2:" . $mn2 . "</br>";
                // echo "final:" .$strt . " -- " . $end. "</br>";
                // echo "<hr>";
            }
        }
        // echo '<pre>';
        // print_r($final);
        // echo '</pre>' . '<br>';

        return view('reservation221', compact("final"));
    }
    public function confirmedTime(Request $request)
    {
        $timearray = explode(".", $request->all("timeduratoin")["timeduratoin"]);

        $attributes = [];

        // prepare attribute for reservation
        // START AND END OF ATTRIBUTE
        if (($timearray[1] / 5) == 12) {
            $startAtt = ($timearray[0] + 1) . "0";
        } else {
            $startAtt = $timearray[0] . (($timearray[1] / 5) + 1);
        }
        $endAtt = $timearray[2] . ($timearray[3] / 5);


        // fill array for reservation
        if ($timearray[0] == $timearray[2]) {
            for ($i = $startAtt; $i < $endAtt + 1; $i++) {
                $attributes[] = $i;
            }
        } else {
            if (($timearray[1] / 5) == 12) {
                $attributes[] = $timearray[0] . ($timearray[1] / 5);
                for ($i = 1; $i < ($timearray[3] / 5) + 1; $i++) {
                    $attributes[] = $timearray[2] . $i;
                }
            } else {
                for ($i = ($timearray[1] / 5) + 1; $i < 13; $i++) {
                    $attributes[] = $timearray[0] . $i;
                }
                for ($i = 1; $i < ($timearray[3] / 5) + 1; $i++) {
                    $attributes[] = $timearray[2] . $i;
                }
            }
        }

        // Fill Session
        $preparedTime = $timearray[0] . ":" . $timearray[1] . "--" . $timearray[2] . ":" . $timearray[3];
        session(['time' => "$preparedTime"]);

        // Maping for fill tables
        $serviceMap = [
            "Basic" => "Basic CarWash",
            "Internal" => "External CarWash",
            "External" => "Internal CarWash"
        ];
        $costMap = [
            "Basic" => "80000",
            "Internal" => "30000",
            "External" => "20000",
        ];


        // Fill Time Table

        $reserve = new Reservation();
        $user = new User;
        //.....................................................
        $user->name = session('name');
        $user->phone = session('phone');
        $user->save();

        $currentUserId = (User::where('phone', session('phone'))->get()->toArray())[0]["id"];
        // dd($currentUserId);


        $reserve->user_id = $currentUserId;
        $reserve->day = session('day');
        $reserve->service = session('service');
        $reserve->time = session('time');
        $reserve->cost = $costMap[session('service')];
        $code = Str::random(8);
        session(['code' => "$code"]);
        $reserve->code = $code;
        $reserve->save();


        // Fill Reservation Table

        // $totaltimetable = new Timetable();
        // $temp=(Timetable::where('day',session('day'))->get()->toArray())[0];
        // dd($temp);

        // $result = DB::table('timetables')
        //     ->select("91")
        //     ->where('day', session('day'))
        //     ->get()->toArray();
        // echo '<pre>';
        // print_r($result);
        // echo '</pre>' . '<br>';
        // $att = 91;
        // echo '<pre>';
        // print_r($result[0]->$att);
        // echo '</pre>' . '<br>';
        // dd($result[0]);


        foreach ($attributes as $key => $value) {
            DB::table('timetables')
                ->where('day', session('day'))
                ->update([$value => DB::raw("+ 1")]);
        }
        // exit;
        // Redirect to final Page
        $code=session("code");
        $day=session("day");
        $time=session("time");
        $service=$serviceMap[session("service")];
        $cost=$costMap[session('service')];
        

        return view('confirmation', compact("cost","day","time","service","code"));
    }

    public function cancel(Request $request) {
        $code=$request->all("cancelcode")["cancelcode"];
        
    
    
    }
}
