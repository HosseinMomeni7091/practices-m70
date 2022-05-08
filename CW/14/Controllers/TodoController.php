<?php
namespace app\Controllers;
use app\Core\View;
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
        (new View)->create("main.php",["layer1.php","layer2.php"],["name"=>"mohammad","lname"=>"Hosseini"]);
    }

    public function store()
    {
        echo "store todos";
    }

    public function toggle()
    {
        echo "toggle todos";
    }
    public function pashe()
    {
        (new View)->show("main.php",["name"=>"mohammad","lname"=>"Hosseini"]);
    }
}
