<?php

namespace app\Controllers;

// require 'app\DB\Medoo.php';
// use app\DB\Medoo\Medoo;


use app\Core\View;
use app\Core\Model;
use app\Model\Tasks;
use app\Model\Users;
use app\Core\Request;
use app\Core\cookie;
use app\Core\Application;

class TodoController
{


    public function index()
    {
        echo "salam";
        // $database = new Medoo([
        //     // [required]
        //     'type' => 'mysql',
        //     'host' => 'localhost',
        //     'database' => 'mvccw14',
        //     'username' => 'root',
        //     'password' => '',
        // ]);

        // $a=$database->select("tasks", "ID");
        // echo '<pre>';
        // print_r($a);
        // echo '</pre>'.'<br>';
    }


    public function register_user()
    {
        // Get data
        echo "salam <br>";
        $data = Application::$app->getInstanceOfClasses("request")->getBody();
        echo '<pre>';
        print_r($data);
        echo '</pre>' . '<br>';

        // Save data into DB
        $user = Users::do();
        $b = $user->create($data);
        Application::$app->getInstanceOfClasses("response")->redirect("/login");
    }

    public function show_login_page()
    {
        Application::$app->getInstanceOfClasses("view")->show("login.php");
    }

    public function login()
    {
        echo "Welcom to Login page";

        // Check with DB
        $data = Application::$app->getInstanceOfClasses("request")->getBody();
        echo '<pre>';
        print_r($data);
        echo '</pre>' . '<br>';

        $name = $data["name"];
        $password = $data["password"];

        $result = Application::$app->getInstanceOfClasses("Auth")->login($name, $password);
        var_dump($result);

        if ($result == false) {
            echo "something(s) is(are) wrong!";
            Application::$app->getInstanceOfClasses("response")->redirect("/");
        }
        if ($result != false) {
            
            echo "welcome   " . $result["name"] . "   " . $result["lastname"] . "   :)";
            
            Application::$app->getInstanceOfClasses("response")->redirect("/profile");
        }
    }
    
    public function profile()
    {
        
        $result = Application::$app->getInstanceOfClasses("Auth")->user();
        
        
    }






    public function alltasks()
    {
        // save data to DB and redirect to final page
        $Tasks = Tasks::do();
        $data = Application::$app->getInstanceOfClasses("request")->getBody();
        echo '<pre>';
        print_r($data);
        echo '</pre>' . '<br>';
        $b = $Tasks->create($data);

        Application::$app->getInstanceOfClasses("response")->redirect("/showalltasks");
    }
    public function showalltasks()
    {
        echo "Welcome to all Tasks";
        // load data from DB to Array
        $Tasks = Tasks::do();
        $data = $Tasks->all();
        echo '<pre>';
        print_r($data);
        echo '</pre>' . '<br>';


        // Pass into $data (befor render of final page)
        Application::$app->getInstanceOfClasses("view")->show("all.php", $data);



        // render final page
    }

    public function show()
    {
        echo "single todo";
    }

    public function create()
    {
        (new View)->create("main.php", ["layer1.php", "layer2.php"], ["name" => "mohammad", "lname" => "Hosseini"]);
    }

    public function store()
    {
        echo "store todos";
    }

    public function userinfo()
    {
        $id = Application::$app->getInstanceOfClasses("request")->getUri();
        $user = Users::do();
        // find data from DB and show in output
        // $data = $user->find();


        exit;
    }

    public function final()
    {
        //show list of tasks from DB
        $user = Users::do();
        $data = $user->all();
        Application::$app->getInstanceOfClasses("view")->create("final.php", [], ["data" => $data]);
    }

    public function storeTask()
    {
        // save data to DB and redirect to final page
        $user = Users::do();
        $data = Application::$app->getInstanceOfClasses("request")->getBody();
        $b = $user->create($data);
        Application::$app->getInstanceOfClasses("response")->redirect("/final");
    }

    public function task()
    {
        // echo "dirname:" . dirname(__DIR__) . "<br>";
        // echo "<hr>";
        // echo "DIR" . __DIR__ . "<br>";
        // echo dirname(__DIR__)."\\view\\". "<br>";
        // echo dirname(__DIR__)."/view". "<br>";
        // echo str_replace("\\","/",dirname(__DIR__)."/view"). "<br>";
        // echo dirname(__DIR__)."\\view\\". "<br>";

        Application::$app->getInstanceOfClasses("view")->show("task.php");
    }


    public function toggle()
    {
        echo "toggle todos";
    }
    public function pashe()
    {

        // $arr = ["name" => "parsa"];
        // print_r((new Users)->create($data)) ;
        // $a=(new Users)->create($data) ;

        // $data = ["name" => "parsa", "lastname" => "jadidi", "password" => "pasheyekhune"];
        // $user=new Users;
        // $b = $user->create($data);

        // echo '<pre>';
        // print_r($b);
        // echo '</pre>'.'<br>';



        // $data1 = ["name" => "parsa2", "lastname" => "madani2", "password" => "halekesafatiam2 "];
        // $b1 = $user->update($data1,"name","parsa");
        // echo '<pre>';
        // print_r($b1);
        // echo '</pre>'.'<br>';

        exit;
        (new View)->show("main.php", ["name" => "mohammad", "lname" => "Hosseini"]);
    }
}
