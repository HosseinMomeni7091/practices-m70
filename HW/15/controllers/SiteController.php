<?php

/**
 * User: TheCodeholic
 * Date: 7/8/2020
 * Time: 8:43 AM
 */

namespace app\controllers;


use core\Request;
use core\Response;
use core\Controller;
use core\Application;
use app\models\User;
use app\models\profile;
use app\models\department;
use app\models\Reservation;
use app\models\LoginForm;
use app\models\Workingtimetabling;
use core\middlewares\AuthMiddleware;

/**
 * Class SiteController
 *
 * @author  Zura Sekhniashvili <zurasekhniashvili@gmail.com>
 * @package app\controllers
 */
class SiteController extends Controller
{
    public function __construct()
    {
        // $this->registerMiddleware(new AuthMiddleware(['profile']));
    }

    public function home()
    {
        $profile = profile::do();
        $tableName1 = $profile::tableName();
        Application::$app->db->table($tableName1);
        $fields = $profile->selectCol(["DISTINCT working_field"]);


        $users = User::do();
        $tableName = $users::tableName();
        // Application::$app->db->table($tableName);


        $list = $profile->join(["*"], $tableName, $tableName1, "INNER", "ID", "user_id");


        // exit;



        $this->setLayout('main');
        if (Application::isGuest()) {
            return $this->render('primarylist', [
                'list' => $list,
                'fields' => $fields
            ]);
        } else {
            return $this->render('Blank', [
                'a' => "a"
            ]);
        }
    }

    public function detail()
    {
        $ID = Application::$app->request->getBody();

        $workingtime = Workingtimetabling::do();
        $tableName2 = $workingtime::tableName();

        $profile = profile::do();
        $tableName1 = $profile::tableName();

        $users = User::do();
        $tableName = $users::tableName();

        $user = $profile->join(["*"], $tableName, $tableName1, "LEFT", "ID", "user_id", "$tableName.ID", $ID["ID"]);


        $timelist = $profile->join(["*"], $tableName, $tableName2, "LEFT", "ID", "user_id", "$tableName.ID", $ID["ID"]);

        // default list--------------
        $final = [
            "Saturday" => [],
            "Sunday" => [],
            "Monday" => [],
            "Tuesday" => [],
            "Wednesday" => [],
            "Thursday" => [],
            "Friday" => []
        ];
        foreach ($final as $key => $value) {
            $final[$key] = [
                "8-9" => 0,
                "9-10" => 0,
                "10-11" => 0,
                "11-12" => 0,
                "12-13" => 0,
                "13-14" => 0,
                "14-15" => 0,
                "15-16" => 0,
                "16-17" => 0,
                "17-18" => 0,
            ];
        }


        // update table according to doctor timesheet
        // echo $timelist[0]["sat_start"] . "<br>";
        // echo $timelist[0]["sat_end"] . "<br>";
        for ($i = $timelist[0]["sat_start"]; $i < $timelist[0]["sat_end"]; $i++) {
            $two = $i + 1;
            $keyy = "$i" . "-" . "$two";
            $final["Saturday"][$keyy] = 1;
        }
        // echo $timelist[0]["sun_start"] . "<br>";
        // echo $timelist[0]["sun_end"] . "<br>";
        for ($i = $timelist[0]["sun_start"]; $i < $timelist[0]["sun_end"]; $i++) {
            $two = $i + 1;
            $keyy = "$i" . "-" . "$two";
            $final["Sunday"][$keyy] = 1;
        }
        // echo $timelist[0]["mon_start"] . "<br>";
        // echo $timelist[0]["mon_end"] . "<br>";
        for ($i = $timelist[0]["mon_start"]; $i < $timelist[0]["mon_end"]; $i++) {
            $two = $i + 1;
            $keyy = "$i" . "-" . "$two";
            $final["Monday"][$keyy] = 1;
        }
        // echo $timelist[0]["tues_start"] . "<br>";
        // echo $timelist[0]["tues_end"] . "<br>";
        for ($i = $timelist[0]["tues_start"]; $i < $timelist[0]["tues_end"]; $i++) {
            $two = $i + 1;
            $keyy = "$i" . "-" . "$two";
            $final["Tuesday"][$keyy] = 1;
        }
        // echo $timelist[0]["wendes_start"] . "<br>";
        // echo $timelist[0]["wendes_end"] . "<br>";
        for ($i = $timelist[0]["wendes_start"]; $i < $timelist[0]["wendes_end"]; $i++) {
            $two = $i + 1;
            $keyy = "$i" . "-" . "$two";
            $final["Wednesday"][$keyy] = 1;
        }
        // echo $timelist[0]["thurs_start"] . "<br>";
        // echo $timelist[0]["thurs_end"] . "<br>";
        for ($i = $timelist[0]["thurs_start"]; $i < $timelist[0]["thurs_end"]; $i++) {
            $two = $i + 1;
            $keyy = "$i" . "-" . "$two";
            $final["Thursday"][$keyy] = 1;
        }
        // echo $timelist[0]["fri_start"] . "<br>";
        // echo $timelist[0]["fri_end"] . "<br>";
        for ($i = $timelist[0]["fri_start"]; $i < $timelist[0]["fri_end"]; $i++) {
            $two = $i + 1;
            $keyy = "$i" . "-" . "$two";
            $final["Friday"][$keyy] = 1;
        }
        // final result up to now
        // echo '<pre> ghable reserve ::::';
        // print_r($final);
        // echo '</pre>' . '<br>';

        // comply with reservation table too 
        // search id of doctor 
        // then disable  time that is under reservation

        $reser = Reservation::do();
        $tableName = $reser::tableName();
        Application::$app->db->table($tableName);
        // find data from DB and show in output
        $all = $reser->find($ID["ID"], "doctor_id");
        // echo '<pre> userfind from login form';
        // print_r($user);
        // echo '</pre>' . '<br>';

        // is exist user with name
        // if (!$all) {
        //     echo "nist dada";
        // }

        // echo '<pre>all reservation';
        // print_r($all);
        // echo '</pre>' . '<br>';

        // echo "reservation";
        foreach ($all as $key => $value) {
            // echo $final[$value["day"]][$value["time"]] . "<br>";
            if ($final[$value["day"]][$value["time"]] == 1) {
                $final[$value["day"]][$value["time"]] = "Reserved";
            }
        }

        // echo '<pre> after reserve ::::';
        // print_r($final);
        // echo '</pre>' . '<br>';

        $this->setLayout('patient');
        return $this->render('detail', [
            'user' => $user,
            'time' => $final
        ]);
    }

    public function reserve()
    {
        echo "reservation";
        $info = Application::$app->request->getBody();
        echo '<pre>';
        print_r($info);
        echo '</pre>' . '<br>';



        $sess = Application::$app->session->get('ID');



        $registerModel = new Reservation();
        $registerModel->{"patient_id"} = $info["user_id"];
        $registerModel->{"doctor_id"} = $info["doctor"];
        $registerModel->{"day"} = $info["day"];
        $registerModel->{"time"} = $info["time"];
        echo '<pre>';
        print_r($registerModel);
        echo '</pre>' . '<br>';
        // exit;
        if (Application::$app->request->getMethod() === 'post') {

            $registerModel->loadData(Application::$app->request->getBody());
            if ($registerModel->validate() && $registerModel->save()) {
                Application::$app->session->setFlash('success', 'Thanks for reservation');
                // echo "ok";
                // exit;
                Application::$app->response->redirect('/reservationlist'); //new request//change request
                return 'Show success page';
            }
        }
    }

    public function reservationlist()
    {
        $sess = Application::$app->session->get('ID');

        $profile = Reservation::do();
        $tableName1 = $profile::tableName();

        $users = User::do();
        $tableName = $users::tableName();

        $all = $profile->join(["*"], $tableName, $tableName1, "Right", "ID", "doctor_id", "$tableName1.patient_id", $sess);
        // echo '<pre>all reservation';
        // print_r($all);
        // echo '</pre>' . '<br>';

        // exit;

        $this->setLayout('patient');
        return $this->render('listreserve', [
            'allreserve' => $all
        ]);
    }
    public function doctorreserve()
    {
        $sess = Application::$app->session->get('ID');

        $profile = Reservation::do();
        $tableName1 = $profile::tableName();

        $users = User::do();
        $tableName = $users::tableName();

        $all = $profile->join(["*"], $tableName, $tableName1, "Right", "ID", "patient_id", "$tableName1.doctor_id", $sess);
        // echo '<pre>all reservation';
        // print_r($all);
        // echo '</pre>' . '<br>';

        // exit;

        $this->setLayout('Doctor');
        return $this->render('listreserveD', [
            'allreserve' => $all
        ]);
    }

    public function timing()
    {
        $ID = Application::$app->request->getBody();
        $sess = Application::$app->session->get('ID');

        $workingtime = Workingtimetabling::do();
        $tableName2 = $workingtime::tableName();

        $users = User::do();
        $tableName = $users::tableName();

        $timelist = $users->join(["*"], $tableName, $tableName2, "LEFT", "ID", "user_id", "$tableName.ID", $sess);

        // default list--------------
        $final = [
            "Saturday" => [],
            "Sunday" => [],
            "Monday" => [],
            "Tuesday" => [],
            "Wednesday" => [],
            "Thursday" => [],
            "Friday" => []
        ];
        foreach ($final as $key => $value) {
            $final[$key] = [
                "8-9" => 0,
                "9-10" => 0,
                "10-11" => 0,
                "11-12" => 0,
                "12-13" => 0,
                "13-14" => 0,
                "14-15" => 0,
                "15-16" => 0,
                "16-17" => 0,
                "17-18" => 0,
            ];
        }


        // update table according to doctor timesheet
        // echo $timelist[0]["sat_start"] . "<br>";
        // echo $timelist[0]["sat_end"] . "<br>";
        for ($i = $timelist[0]["sat_start"]; $i < $timelist[0]["sat_end"]; $i++) {
            $two = $i + 1;
            $keyy = "$i" . "-" . "$two";
            $final["Saturday"][$keyy] = 1;
        }
        // echo $timelist[0]["sun_start"] . "<br>";
        // echo $timelist[0]["sun_end"] . "<br>";
        for ($i = $timelist[0]["sun_start"]; $i < $timelist[0]["sun_end"]; $i++) {
            $two = $i + 1;
            $keyy = "$i" . "-" . "$two";
            $final["Sunday"][$keyy] = 1;
        }
        // echo $timelist[0]["mon_start"] . "<br>";
        // echo $timelist[0]["mon_end"] . "<br>";
        for ($i = $timelist[0]["mon_start"]; $i < $timelist[0]["mon_end"]; $i++) {
            $two = $i + 1;
            $keyy = "$i" . "-" . "$two";
            $final["Monday"][$keyy] = 1;
        }
        // echo $timelist[0]["tues_start"] . "<br>";
        // echo $timelist[0]["tues_end"] . "<br>";
        for ($i = $timelist[0]["tues_start"]; $i < $timelist[0]["tues_end"]; $i++) {
            $two = $i + 1;
            $keyy = "$i" . "-" . "$two";
            $final["Tuesday"][$keyy] = 1;
        }
        // echo $timelist[0]["wendes_start"] . "<br>";
        // echo $timelist[0]["wendes_end"] . "<br>";
        for ($i = $timelist[0]["wendes_start"]; $i < $timelist[0]["wendes_end"]; $i++) {
            $two = $i + 1;
            $keyy = "$i" . "-" . "$two";
            $final["Wednesday"][$keyy] = 1;
        }
        // echo $timelist[0]["thurs_start"] . "<br>";
        // echo $timelist[0]["thurs_end"] . "<br>";
        for ($i = $timelist[0]["thurs_start"]; $i < $timelist[0]["thurs_end"]; $i++) {
            $two = $i + 1;
            $keyy = "$i" . "-" . "$two";
            $final["Thursday"][$keyy] = 1;
        }
        // echo $timelist[0]["fri_start"] . "<br>";
        // echo $timelist[0]["fri_end"] . "<br>";
        for ($i = $timelist[0]["fri_start"]; $i < $timelist[0]["fri_end"]; $i++) {
            $two = $i + 1;
            $keyy = "$i" . "-" . "$two";
            $final["Friday"][$keyy] = 1;
        }
        // final result up to now
        // echo '<pre> ghable reserve ::::';
        // print_r($final);
        // echo '</pre>' . '<br>';

        $this->setLayout('Doctor');
        return $this->render('detailD', [
            'time' => $final
        ]);
    }

    public function filter()
    {
        $profile = profile::do();
        $tableName1 = $profile::tableName();
        Application::$app->db->table($tableName1);
        $fields = $profile->selectCol(["DISTINCT working_field"]);

        $filter = Application::$app->request->getBody();

        $profile = profile::do();
        $tableName1 = $profile::tableName();

        $users = User::do();
        $tableName = $users::tableName();

        if ($filter["specialty"] == "all") {
            $user = $profile->join(["*"], $tableName, $tableName1, "INNER", "ID", "user_id");
        } else {
            $user = $profile->join(["*"], $tableName, $tableName1, "INNER", "ID", "user_id", "$tableName1.working_field", $filter["specialty"]);
        }

        $this->setLayout('main');
        return $this->render('primarylist', [
            'list' => $user,
            'fields' => $fields
        ]);
    }
    public function search()
    {
        $profile = profile::do();
        $tableName1 = $profile::tableName();
        Application::$app->db->table($tableName1);
        $fields = $profile->selectCol(["DISTINCT working_field"]);



        $search = Application::$app->request->getBody();

        $profile = profile::do();
        $tableName1 = $profile::tableName();

        $users = User::do();
        $tableName = $users::tableName();

        if ($search["name"] == "") {
            $user = $profile->join(["*"], $tableName, $tableName1, "INNER", "ID", "user_id");
        } else {
            $user = $profile->join(["*"], $tableName, $tableName1, "INNER", "ID", "user_id", "$tableName.name", $search["name"]);
        }

        $this->setLayout('main');
        return $this->render('primarylist', [
            'list' => $user,
            'fields' => $fields
        ]);
    }



    public function manager()
    {
        $this->setLayout('manager');
        return $this->render('home', [
            'name' => "manager"
        ]);
    }
    public function userconfirmation()
    {
        $this->setLayout('manager');
        return $this->render('userconfirmation', [
            'name' => "manager"
        ]);
    }
    public function departments()
    {
        $this->setLayout('manager');
        return $this->render('Departments', [
            'name' => "manager"
        ]);
    }
    public function doctor()
    {
        $this->setLayout('doctor');
        return $this->render('Blank', [
            'name' => "doctor"
        ]);
    }
    public function workingtimetabling()
    {

        $this->setLayout('doctor');
        return $this->render('workingtimetabling', [
            'name' => "doctor"
        ]);
    }

    public function doctortime()
    {

        $registerModel = new Workingtimetabling();
        if (Application::$app->request->getMethod() === 'post') {

            $registerModel->loadData(Application::$app->request->getBody());
            // echo '<pre>files';
            // print_r($_FILES);
            // echo '</pre>' . '<br>';
            echo '<pre>_post:::::';
            print_r($_POST);
            echo '</pre>' . '<br>';
            echo '<pre> from request ::::';
            print_r($registerModel);
            echo '</pre>' . '<br>';
            echo '<pre> Validate ::::';
            var_dump($registerModel->validate());
            echo '</pre>' . '<br>';
            echo '<pre> save :::::::';
            var_dump($registerModel->save());
            echo '</pre>' . '<br>';
            // exit;
            // validation ---- first hash pass in user and then save in DbModel 
            if ($registerModel->validate() && $registerModel->save()) {
                echo "Ok hode";
                Application::$app->session->setFlash('success', 'Thanks for completing workingtimetabling');
                Application::$app->response->redirect('/doctor'); //new request//change request
                return 'Show success page';
            }
        }
        // $this->setLayout('doctor');
        // return $this->render('workingtimetabling', [
        //     'model' => "blank"
        // ]);

    }

    public function timesofdoctors()
    {
        $profile = profile::do();
        $tableName1 = $profile::tableName();
        Application::$app->db->table($tableName1);
        $fields = $profile->selectCol(["DISTINCT working_field"]);


        $users = User::do();
        $tableName = $users::tableName();
        // Application::$app->db->table($tableName);

        $list = $profile->join(["*"], $tableName, $tableName1, "INNER", "ID", "user_id");

        $this->setLayout('patient');
        return $this->render('doctors', [
            'list' => $list,
            'fields' => $fields
        ]);
    }

    public function login(Request $request)
    {
        $loginForm = new LoginForm();
        if ($request->getMethod() === 'post') {
            // echo "salam";
            // Check with DB
            $data = Application::$app->request->getBody();
            // echo '<pre> DATA';
            // print_r($data);
            // echo '</pre>' . '<br>';
            // // exit;

            $username = $data["username"];
            $password = $data["password"];

            $result = $loginForm->login($username, $password);
            // echo "userfind data";
            // echo '<pre>';
            // print_r($result);
            // echo '</pre>'.'<br>';

            if ($result == false) {
                echo "something(s) is(are) wrong!";
                Application::$app->response->redirect("/login");
            }
            if ($result != false) {

                // echo "welcome   " . $result["name"] . "   " . $result["family"] . "   :)";
                // check session 
                // $sess = Application::$app->session->get('ID');
                // echo "******sess" . "<br>";
                // echo '<pre>';
                // var_dump($sess);
                // echo '</pre>' . '<br>';

                if ($result["position"] == "Doctor") {
                    $this->setLayout('doctor');
                    return $this->render('WelcomeD', [
                        'list' => $result
                    ]);
                } elseif ($result["position"] == "Patient") {

                    $this->setLayout('patient');
                    return $this->render('WelcomeP', [
                        'list' => $result
                    ]);
                } elseif ($result["position"] == "Manager") {

                    $this->setLayout('manager');
                    return $this->render('WelcomeM', [
                        'list' => $result
                    ]);
                }


                // exit;
                // Application::$app->response->redirect("/profile");
            }


            // //filter data and asignment to related property
            // $loginForm->loadData($request->getBody());
            // // validat input -- check requested email is existed or not? check password is coorect or not?
            // if ($loginForm->validate() && $loginForm->login()) {
            //     Application::$app->response->redirect('/profile');
            //     return;
            // }
        }
        $this->setLayout('main');
        return $this->render('login', [
            'model' => $loginForm
        ]);
    }

    public function register(Request $request)
    {
        $registerModel = new User();
        if ($request->getMethod() === 'post') {
            $registerModel->loadData($request->getBody());
            echo '<pre>';
            print_r($registerModel);
            echo '</pre>' . '<br>';
            // validation ---- first hash pass in user and then save in DbModel 
            // echo "validate::::".$registerModel->validate();
            // echo "save::::".$registerModel->save();
            // exit;

            if ($registerModel->validate() && $registerModel->save()) {
                Application::$app->session->setFlash('success', 'Thanks for registering');
                Application::$app->response->redirect('/login'); //new request//change request
                return 'Show success page';
            }
        }
        $this->setLayout('main');
        return $this->render('register', [
            'model' => $registerModel
        ]);
    }


    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }

    public function contact()
    {
        return $this->render('contact');
    }

    public function profile()
    {
        $sess = Application::$app->session->get('ID');
        Application::$app->user;

        $Department = Department::do();
        $tableName = $Department::tableName();
        Application::$app->db->table($tableName);
        $ListofDepartments = $Department->selectCol(["DISTINCT name , ID"]);

        $this->setLayout('doctor');
        return $this->render('profile', [
            'list' => $ListofDepartments
        ]);
    }

    public function profilesaver()
    {
        $registerModel = new Profile();
        if (Application::$app->request->getMethod() === 'post') {

            $registerModel->loadData(Application::$app->request->getBody());
            // echo '<pre>files';
            // print_r($_FILES);
            // echo '</pre>' . '<br>';
            // echo '<pre>post';
            // print_r($_POST);
            // echo '</pre>' . '<br>';
            // echo '<pre>';
            // print_r($registerModel);
            // echo '</pre>' . '<br>';
            // exit;
            // validation ---- first hash pass in user and then save in DbModel 
            if ($registerModel->validate() && $registerModel->save()) {
                Application::$app->session->setFlash('success', 'Thanks for completing profile');
                Application::$app->response->redirect('/doctor'); //new request//change request
                return 'Show success page';
            }
        }
        $this->setLayout('doctor');
        return $this->render('profile', [
            'model' => $registerModel
        ]);
    }

    public function profileWithId(Request $request)
    {
        echo '<pre>';
        var_dump($request->getBody());
        echo '</pre>';
    }
}
