<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Timetable;
use App\Models\Reservation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class usercontroller extends Controller
{

    public function home(Request $request)
    {
        $request->session()->forget(['name', 'phone', 'day', 'service', 'track', 'time', 'code', "edite", "pretime"]);
        return view('Auth.login');
    }
    public function resrevationbase(Request $request)
    {
        return view('reservation');
    }
    public function type(Request $request)
    {
        // dd($request->all());
        // session(["name" => $request->all("name")["name"]]);
        // session(["phone" => $request->all("phone")["phone"]]);
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
        $service = $request->session()->get("service");
        $days = [
            0 => "Saturday",
            1 => "Sunday",
            2 => "Monday",
            3 => "Tuesday",
            4 => "Wednesday",
            5 => "Thursday",
            6 => "Friday"
        ];
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

        foreach ($days as $key => $day) {
            $alltime = $all[$map1[$day]];
            unset($alltime['id']);
            unset($alltime['day']);
            for ($i = 0; $i < 144; $i++) {
                $result = 1;
                for ($j = 0; $j < $map2[$service]; $j++) {
                    if (($alltime[$i + $j] ?? 2) == 2) {
                        $result = $result * 0;
                    }
                }
                if ($result == 1) {
                    // Cal start time
                    $hr1 = floor($i / 12) + 9;
                    $mn1 = (($i - floor($i / 12) * 12)) * 5;
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
                }
            }
            if (count($final)) {
                $finaltime = $final[0];
                $finalday = $day;
            }
            if ($finaltime) {
                break;
            }
        }

        // session --------------------
        $interf = $finaltime["start"][0] . "." . $finaltime["start"][1] . "." . $finaltime["end"][0] . "." . $finaltime["end"][1];
        session(['pretime' => $interf]);
        session(['day' => "$finalday"]);
        $Day = session("day");
        $Time = session("pretime");

        // redirect data into related view
        return view('reservation21', compact("Day", "Time"));
    }

    public function autotoConfirmation(Request $request)
    {

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

        // Redirect to final Page
        $code = Str::random(8);
        session(['code' => "$code"]);
        $day = session("day");
        $time = session("time");
        $service = $serviceMap[session("service")];
        $cost = $costMap[session('service')];

        $request->session()->forget('track');
        return view('confirmation', compact("cost", "day", "time", "service", "code"));
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
        $request->session()->forget('track');
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
        // print_r($request->session()->all());
        // echo '</pre>'.'<br>';
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
                    // echo "i+j =  ".$alltime[$i + $j]. "</br>";
                }
                // echo "j:" . $j . "</br>";
                // echo "i+j =  ".$alltime[$i + $j]. "</br>";
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

        if ($request->session()->has('pretime')) {
            $timearray = explode(".", session("pretime"));
        }

        // prepare attribute for reservation
        // START AND END OF ATTRIBUTE
        $attributes = [];

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


        // Fill user and reserve table 

        $reserve = new Reservation();
        $user = new User;
        //.....................................................

        // check user in DB
        $a = (DB::table('users')
            ->select("id")
            ->where('phone', session('phone'))
            ->get()
            ->toArray());

        if ($a) {
            $currentUserId = ($a)[0]->id;
        }

        if (!$a) {
        
            $user->name = session('name');
            $user->family = session('family');
            $user->phone = session('phone');
            $user->email = session('email');
            $user->password = Hash::make(session('password')["password"]);
            dd(session()->all());
            // $user->password = bcrypt(session('password'));
            $user->save();
            $a = (DB::table('users')
                ->select("id")
                ->where('phone', session('phone'))
                ->get()
                ->toArray());
            $currentUserId = ($a)[0]->id;
        }

        if (!session("track")) {
            // fill reserve table/model
            $reserve->user_id = $currentUserId;
            $reserve->day = session('day');
            $reserve->service = session('service');
            $reserve->time = session('time');
            $reserve->cost = $costMap[session('service')];
            $code = Str::random(8);
            session(['code' => "$code"]);
            $reserve->code = session("code");
            $reserve->save();
        }

        // save data into DB (increase data by one )
        foreach ($attributes as $key => $value) {
            $a = (DB::table('timetables')
                ->select($value)
                ->where('day', session('day'))
                ->get());
            $a = ($a->toArray())[0]->$value;
            $a = $a + 1;

            DB::table('timetables')
                ->where('day', session('day'))
                ->update([$value => $a]);
        }
       

        if ($request->session()->has('edite')) {
            $code = session("edite");

            // get data from DB reservation
            $time = (DB::table('reservations')
                ->select("time")
                ->where('code', $code)
                ->get())[0]->time;


            $alltime = explode("--", $time);
            $start = explode(":", $alltime[0]);
            $end = explode(":", $alltime[1]);

            $day = (DB::table('reservations')
                ->select("day")
                ->where('code', $code)
                ->get())[0]->day;

            // delete from reservation
            $time = DB::table('reservations')
                ->where('code', $code)
                ->delete();


            // delete from timetable
            $timearray = [$start[0], $start[1], $end[0], $end[1]];

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
            foreach ($attributes as $key => $value) {
                $a = (DB::table('timetables')
                    ->select($value)
                    ->where('day', $day)
                    ->get());
                $a = ($a->toArray())[0]->$value;
                $a = $a - 1;
                DB::table('timetables')
                    ->where('day', $day)
                    ->update([$value => $a]);
            }
        }
        
     
         // Redirect to final Page
         $code = session("code");
         $day = session("day");
         $time = session("time");
         $service = $serviceMap[session("service")];
         $cost = $costMap[session('service')];
        $request->session()->forget(['track', "edite", "pretime"]);

        return view('confirmation', compact("cost", "day", "time", "service", "code"));
    }

    public function cancel(Request $request)
    {
        $code = $request->all("cancelcode")["cancelcode"];
        $time = (DB::table('reservations')
            ->select("time")
            ->where('code', $code)
            ->get())[0]->time;

        $alltime = explode("--", $time);
        $start = explode(":", $alltime[0]);
        $end = explode(":", $alltime[1]);

        $day = (DB::table('reservations')
            ->select("day")
            ->where('code', $code)
            ->get())[0]->day;

        // delete from reservation
        $time = DB::table('reservations')
            ->where('code', $code)
            ->delete();


        // delete from timetable
        $timearray = [$start[0], $start[1], $end[0], $end[1]];

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
        // exit;

        foreach ($attributes as $key => $value) {
            $a = (DB::table('timetables')
                ->select($value)
                ->where('day', $day)
                ->get());
            $a = ($a->toArray())[0]->$value;
            $a = $a - 1;

            DB::table('timetables')
                ->where('day', $day)
                ->update([$value => $a]);
        }
        $request->session()->forget([ 'track', "edite","pretime"]);
        
        return view('cancel');
    }
    public function searchtracknumber(Request $request)
    {
        $request->session()->forget(['name', 'phone', 'day', 'service', 'track', 'time', 'code', "edite"]);

        $phone = $request->all("phone")["phone"];
        $track = $request->all("track")["track"];
        $Totaltable = DB::table('users')
            ->join('reservations', 'users.id', '=', 'reservations.user_id')
            ->select('users.*', 'reservations.*')
            ->where('phone', '=', $phone)
            ->where('reservations.code', '=', $track)
            ->get()
            ->toArray();

        if ($Totaltable) {

            // set session
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
            session(['time' => $Totaltable[0]->time]);
            session(['phone' => $Totaltable[0]->phone]);
            session(['name' => $Totaltable[0]->name]);
            session(['code' => $Totaltable[0]->code]);
            session(['day' => $Totaltable[0]->day]);
            session(['service' => $Totaltable[0]->service]);
            session(['track' => 'true']);

            $code = session("code");
            $day = session("day");
            $time = session("time");
            $service = $serviceMap[session("service")];
            $cost = $costMap[session('service')];


            // send to confirmation
            return view('confirmation', compact("cost", "day", "time", "service", "code"));
        } else {

            // redirect to new view
            return view('wrongpass');
        }
    }

    public function edite(Request $request)
    {
        $code = $request->all("editecode")["editecode"];
        session(["edite" => $code]);
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
}
