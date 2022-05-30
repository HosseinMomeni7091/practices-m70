<?php

/**
 * User: TheCodeholic
 * Date: 7/8/2020
 * Time: 8:43 AM
 */

namespace app\controllers;


use core\Request;
use core\Response;
use app\models\User;
use core\Controller;
use core\Application;
use app\models\profile;
use app\models\LoginForm;
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
        // if (Application::isGuest()){
            return $this->render('primarylist', [
                'list' => $list,
                'fields' => $fields
            ]);
        // }else{
        //     return $this->render('primarylist', [
        //         'list' => $list,
        //         'fields' => $fields
        //     ]);
        // }
    }

    public function detail()
    {
        $ID = Application::$app->request->getBody();
 
        $profile = profile::do();
        $tableName1 = $profile::tableName();

        $users = User::do();
        $tableName = $users::tableName();

        $user = $profile->join(["*"],$tableName,$tableName1,"LEFT","ID","user_id","$tableName.ID",$ID["ID"]);

        $this->setLayout('main');
        return $this->render('detail', [
            'user' => $user
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

        if ($filter["specialty"]=="all"){
            $user = $profile->join(["*"],$tableName,$tableName1,"INNER","ID","user_id");
        }else{
            $user = $profile->join(["*"],$tableName,$tableName1,"INNER","ID","user_id","$tableName1.working_field",$filter["specialty"]);
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

        if($search["name"]==""){
            $user = $profile->join(["*"],$tableName,$tableName1,"INNER","ID","user_id");
        }else{
            $user = $profile->join(["*"],$tableName,$tableName1,"INNER","ID","user_id","$tableName.name",$search["name"]);
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
        return $this->render('home', [
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

    public function login(Request $request)
    {
        $loginForm = new LoginForm();
        if ($request->getMethod() === 'post') {
            echo "salam";
            // Check with DB
            $data = Application::$app->request->getBody();
            echo '<pre>';
            print_r($data);
            echo '</pre>' . '<br>';
            // // exit;

            $username = $data["username"];
            $password = $data["password"];

            $result = $loginForm->login($username, $password);
            var_dump($result);

            if ($result == false) {
                echo "something(s) is(are) wrong!";
                Application::$app->response->redirect("/login");
            }
            if ($result != false) {

                echo "welcome   " . $result["name"] . "   " . $result["family"] . "   :)";
                $sess = Application::$app->session->get('ID');
                echo "******sess" . "<br>";
                echo '<pre>';
                var_dump($sess);
                echo '</pre>' . '<br>';
                // exit;
                Application::$app->response->redirect("/profile");
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
            // validation ---- first hash pass in user and then save in DbModel 
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
        return $this->render('profile');
    }

    public function profileWithId(Request $request)
    {
        echo '<pre>';
        var_dump($request->getBody());
        echo '</pre>';
    }
}
