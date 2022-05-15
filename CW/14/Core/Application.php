<?php

namespace app\Core;

use app\Core\db\Connection;
use app\Core\db\MySqlDatabase;
use app\Model\Users;

class Application
{

    private Router $router;
    private Request $request;
    private Response $response;
    private View $view;
    private Model $user;
    private MySqlDatabase $db;


    public static $app;

    public function __construct()
    {
        $this->router = new Router();
        $this->request = new Request();
        $this->response = new Response();
        $this->view = new View();
        $this->db = new MySqlDatabase(Connection::getInstance());
        

        self::$app = $this;
    }
    
    // total getter
    public function getInstanceOfClasses($name)
    {
        return (!property_exists($this, $name)) ? null : $this->$name;
    }

    public function run()
    {
        $this->router->resolve();
    }
}
