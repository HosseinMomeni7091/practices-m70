<?php
require "vendor/autoload.php";

 
use app\Core\Application;
use app\Controllers\TodoController;

//  print_r($_SERVER);die();
 $app = new Application();
 $TC=new TodoController;
 
$app->getInstanceOfClasses('router')->get('/todos',[TodoController::class,"index"]);

$app->getInstanceOfClasses('router')->get('/todos/show',[TodoController::class,"show"]);

$app->getInstanceOfClasses('router')->get('/todos/create',[TodoController::class,"create"]);

$app->getInstanceOfClasses('router')->post('/todos',[TodoController::class,"store"]);

$app->getInstanceOfClasses('router')->get('/task',[TodoController::class,"task"]);//run and get

$app->getInstanceOfClasses('router')->post('/task',[TodoController::class,"storeTask"]);//

$app->getInstanceOfClasses('router')->get('/final',[TodoController::class,"final"]);

$app->getInstanceOfClasses('router')->get('/user',[TodoController::class,"userinfo"]);

$app->getInstanceOfClasses('router')->get('/',[TodoController::class,"pashe"]);


$app->run();


// $path=$_SERVER["REQUEST_URI"];
// $method=$_SERVER["REQUEST_METHOD"];
// $app->router->resolve($path,$method);

//  $app->UserRouter($router1);
?>