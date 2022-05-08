<?php
require "vendor/autoload.php";

 
use app\Core\Application;
use app\Controllers\TodoController;

//  print_r($_SERVER);die();
 $app = new Application();
 $TC=new TodoController;
 
$app->router->get('/todos',[TodoController::class,"index"]);

$app->router->get('/todos/show',[TodoController::class,"show"]);

$app->router->get('/todos/create',[TodoController::class,"create"]);

$app->router->post('/todos',[TodoController::class,"store"]);

$app->router->get('/todos/toggle',[TodoController::class,"toggle"]);

$app->router->get('/',[TodoController::class,"pashe"]);


$path=$_SERVER["REQUEST_URI"];
$method=$_SERVER["REQUEST_METHOD"];
$app->router->resolve($path,$method);

//  $app->UserRouter($router1);
?>