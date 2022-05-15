<?php

namespace app\Controllers;

use app\Core\Application;
use app\Core\Model;
use app\Core\Request;
use app\Core\View;
use app\Model\Users;
use app\Model\Tasks;

class TodoController
{


    public function index()
    {
        echo "all todos";
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
