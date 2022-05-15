<?php

namespace app\Core;

class Router
{

    protected array $route = [];

    //.................................
    public function __construct()
    {
    }



    public function get($path, $callback)
    {
        $this->route["GET"][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->route["POST"][$path] = $callback;
    }
    public function resolve()
    {

        $method = Application::$app->getInstanceOfClasses('request')->getMethod();
        $path = Application::$app->getInstanceOfClasses('request')->getUri();

        $position = strpos($path, '?');
        if ($position !== false) {
            $path = substr($path, 0, $position);
        }
        
        $callback = $this->route[$method][$path] ?? Null;

        if (is_null($callback)) {
            Application::$app->getInstanceOfClasses('response')->setStatusCode(404);
            exit("page not found 404  ");
        }

        if (is_array($callback)) {
            $callback[0] = new $callback[0];
        }

        return call_user_func($callback);
    }
}
