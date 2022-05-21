<?php

namespace app\Core;

use app\Model\Users;
use app\Core\db\Connection;
use app\Core\db\MySqlDatabase;

class Application
{

    private Router $router;
    private Request $request;
    private Response $response;
    private View $view;
    private Auth $Auth;
    private Cookie $cookie;
    private Model $user;
    private MySqlDatabase $db;


    public static $app;

    public function __construct()
    {
        $this->router = new Router();
        $this->request = new Request();
        $this->response = new Response();
        $this->view = new View();
        $this->Auth = new Auth();
        $this->cookie = New Cookie();
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

        try {
            $this->router->resolve();
        } catch (\Exception $e ) {
            //you dont have permission to access on this site
        }
    }
}
